<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Response;

class HomeController
{
    public function index($filename)
    {
        $contents = Storage::get($filename);
        $mime = Storage::mimeType($filename);

        return response($contents)
            ->header('Content-Type', $mime);
    }
}
