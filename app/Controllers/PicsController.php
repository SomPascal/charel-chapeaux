<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

class PicsController extends BaseController
{
    public function item(string $item_id): Response
    {
        $item_folder = WRITEPATH . 'uploads\items\\';
        $item_path = $item_folder . $item_id . '.png';

        if (! is_file($item_path)) {
            $item_path = $item_folder . 'default.png';
        }

        return $this->response->setBody(file_get_contents($item_path))
        ->setHeader('Content-Type', 'image/png');
    }
}
