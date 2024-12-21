<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ItemModel;
use App\Models\ItemPicsModel;
use CodeIgniter\API\ResponseTrait;
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
        return view('Admin/create-item', [
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

            try {
                if (model(ItemPicsModel::class)->insert(row: [
                    'id' => $file_id,
                    'item_id' => $item_id,
                    'extension' => $extension,
                    'created_at' => Time::now()
                ], returnID: false))
                {
                    if ($file->isValid()) {
                        $file->store('items', $file_id . '.' . $extension);
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

        return $this->respondCreated(['i' => $i]);
    }

    public function show()
    {
        return view('item');
    }

    public function like(): Response
    {
        return $this->response->setBody('liked');
    }

    public function unlike(): Response
    {
        return $this->response->setBody('unliked');
    }
}
