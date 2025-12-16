<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

class Landing extends Controller
{
    public function index()
    {
        $path = FCPATH . 'landing/index.html';

        if (!is_file($path)) {
            throw PageNotFoundException::forPageNotFound("Landing page tidak ditemukan.");
        }

        return $this->response
            ->setContentType('text/html')
            ->setBody(file_get_contents($path));
    }
}
