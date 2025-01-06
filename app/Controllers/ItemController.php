<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ItemModel;
use App\Models\ItemPicsModel;
use App\Models\RedirectionModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Config\Services;
use Psr\Log\LogLevel;

class ItemController extends BaseController
{
    use ResponseTrait;

    public function create(): string
    {        
        return view('Admin/Create/item', [
            'categories' => model(CategoryModel::class)->getAll()
        ]);
    }

    protected function uploadPics(array $pics, string $item_id, string $extension='png', int $files_limit=10): void 
    {
        $i = 0;

        foreach ($pics as $file)
        {
            /**
             * @var UploadedFile $file
             */
            $i++;
            
            if ($i > $files_limit) {
                break;
            }
    
            $file_id = uid();
            $file_path =  $file_id . '.' . $extension;

            try {
                if (model(ItemPicsModel::class)->insert(row: [
                    'id' => $file_id,
                    'item_id' => $item_id,
                    'extension' => $extension,
                    'created_at' => Time::now()
                ], returnID: false))
                {
                    if ($file->isValid()) {
                        $file->store('items', $file_path);
                    }
                }
            } catch (\Throwable $e) {
                log_message(
                    level: LogLevel::ERROR,
                    message: sprintf(
                        "Could not save item pic due to: %s\n%s\n",
                        $e->getMessage(),
                        $e->getTraceAsString()
                    ),
                    context: [
                        'item_id' => $item_id,
                        'username' => auth()->user()->username
                    ]
                );
            }
        }
    }

    public function store(): Response
    {
        if (! $this->validate('store_item'))
        {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $user = auth()->user();

        $data = $this->validator->getValidated();
        $itemModel = model(ItemModel::class);
        $item_id = uid();

        try {
            if (! $itemModel->insert(row: [
                'id' => $item_id,
                'admin_id' => user_id(),
                'code_category' => $data['categories'],
                'name' => $data['item-name'],
                'price' => $data['item-price'],
                'description' => $data['item-description'],
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ], returnID: false)) 
            {
                log_message(
                    level: LogLevel::ERROR,
                    message: 'Could not record item',
                    context: ['admin' => $user->username]
                );

                return $this->failServerError();
            }
        } 
        catch (\Throwable $e) 
        {
            log_message(
                level: LogLevel::ERROR,
                message: 'Could not record item due to: ' . $e->getMessage(),
                context: ['admin' => $user->username]
            );

            return $this->failServerError();
        }

        $this->uploadPics(
            pics: $this->request->getFiles()['item-images'],
            item_id: $item_id
        );
        
        session()->setTempdata(
            'success', 
            'Votre article a été enregistré avec succès.',
            5*SECOND
        );

        return $this->respondCreated()->setHeader(
            X_REDIRECT_TO, 
            url_to('admin.items')
        );
    }

    public function update(): Response
    {
        if (! $this->validate('store_item'))
        {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $user = auth()->user();

        $data = $this->validator->getValidated();
        $data['item-id'] = $this->request->getPost('item-id');

        $item_model = model(ItemModel::class);
        $item_pics_model = model(ItemPicsModel::class);

        try {
            if (! $item_model->update(id: $data['item-id'], row: [
                'code_category' => $data['categories'],
                'name' => $data['item-name'],
                'price' => $data['item-price'],
                'description' => $data['item-description'],
                'updated_at' => Time::now()
            ])) 
            {
                log_message(
                    level: LogLevel::ERROR,
                    message: 'Could not update item',
                    context: ['admin' => $user->username]
                );

                return $this->failServerError();
            }
        } 
        catch (\Throwable $e) 
        {
            log_message(
                level: LogLevel::ERROR,
                message: sprintf(
                    "Could not record item due to: %s\n%s", 
                    $e->getMessage(),
                    $e->getTraceAsString()
                ),
                context: ['admin' => $user->username]
            );

            return $this->failServerError();
        }

        $unselected_item_images = json_decode(
            $this->request->getPost('unselected-item-images'),
            true
        );

        if (json_last_error() != JSON_ERROR_SYNTAX && count($unselected_item_images) > 0)
        {
            foreach ($unselected_item_images as $pic_id)
            {
                try {
                    $item_pics_model->update(id: $pic_id, row: [
                        'deleted_at' => Time::now()
                    ]);
                } catch (\Throwable $e) {
                    log_message(
                        LogLevel::ERROR,
                        sprintf(
                            'Could delete item pic due to :%s\n%s',
                            $e->getMessage(),
                            $e->getTraceAsString()
                        ),
                        context: ['pic_id' => $pic_id]
                    );
                }
            }
        }

        if (! empty($this->request->getFiles()['item-images'])) {
            $this->uploadPics(
                pics: $this->request->getFiles()['item-images'],
                item_id: $data['item-id']
            );
        }

        session()->setTempdata(
            'success', 
            'Votre article a été modifié avec succès.',
            5*SECOND
        );

        return $this->respondUpdated()->setHeader(
            X_REDIRECT_TO, 
            url_to('admin.items')
        );
    }
    
    public function modify(string $item_id)
    {
        $item = model(ItemModel::class)->asObject()->get_item($item_id);

        if ($item == null) {
            throw new PageNotFoundException("Error Processing Request");
        }
        
        return view('Admin/Create/modify-item', [
            'item' => $item,
            'item_pics' => model(ItemPicsModel::class)->get_item_pics($item_id),
            'categories' => model(CategoryModel::class)->getAll()
        ]);
    }

    public function show(string $item_id): string
    {
        $item_model = model(ItemModel::class);
        $item_pics_model = model(ItemPicsModel::class);
        $item = $item_model->asObject()->get_item($item_id);

        if ($item == null || ($item->is_hidden == true && ! auth()->loggedIn())) {
            throw new PageNotFoundException("Error Processing Request");
        }

        return view('item', [
            'item' => $item,
            'item_props' => $item_model->in_category($item->category_code)
            ->get_items()->findAll(limit: 7),
            'item_pics' => $item_pics_model->get_item_pics($item_id),
            'redirections' => model(RedirectionModel::class)->todayRedirections()
        ]);
    }

    public function hide(): Response
    {
        $item_id = $this->request->getJsonVar('item_id');

        try {
            if (! model(ItemModel::class)->hide($item_id))
            {
                return $this->failServerError();
            }
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                'Could not hide an item due to: ' . $e->getMessage(),
                ['item_id' => $item_id, 'user_email' => auth()->user()->email]
            );

            return $this->failServerError();
        }

        session()->setTempdata(
            'success', 
            'Cette article à été caché avec succès.',
            5*SECOND
        );

        return $this->respondUpdated();
    }

    public function unhide(): Response
    {
        $item_id = $this->request->getJsonVar('item_id');

        try {
            if (! model(ItemModel::class)->unhide($item_id))
            {
                return $this->failServerError();
            }
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                'Could not unhide an item due to: ' . $e->getMessage(),
                ['item_id' => $item_id, 'user_email' => auth()->user()->email]
            );

            return $this->failServerError();
        }

        session()->setTempdata(
            'success', 
            'Cette article s\'affiche à présent avec succès.',
            5*SECOND
        );

        return $this->respondUpdated();
    }

    public function delete(): Response
    {
        $item_id = $this->request->getJsonVar('item_id');

        try {
            if (! model(ItemModel::class)->add_in_trash($item_id))
            {
                return $this->failServerError();
            }
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                'Could not delete an item due to: ' . $e->getMessage(),
                ['item_id' => $item_id, 'user_email' => auth()->user()->email]
            );

            return $this->failServerError();
        }

        session()->setTempdata(
            'success', 
            'Cette article à été supprimé avec succès.',
            5*SECOND
        );

        return $this->respondUpdated();
    }

}
