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
        
        $extension = 'png';
        $i = 0;
        $files_limit = 10;
        
        foreach ($this->request->getFiles()['item-images'] as $file)
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

            log_message('info', json_encode([
                'file' => $file_path,
                'file_id' => $file_id
            ]));

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
                    message: 'Could not save item pic due to: ' . $e->getMessage(),
                    context: [
                        'item_id' => $item_id,
                        'username' => $user->username
                    ]
                );
            }
        }

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

    public function modify(string $item_id)
    {
        $item = model(ItemModel::class)->asObject()->get_item($item_id);

        if ($item == null) {
            throw new PageNotFoundException("Error Processing Request");
        }

        dd($item);
    }
}
