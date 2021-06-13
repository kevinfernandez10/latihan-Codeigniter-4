<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Halaman Homes'
        ];
        return view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'judul' => 'halaman About'
        ];
        return view('pages/about', $data);
    }
}
