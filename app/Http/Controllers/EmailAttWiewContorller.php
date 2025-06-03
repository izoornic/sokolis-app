<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Response;

class EmailAttWiewContorller
{
    public function index($filename)
    {
        $contents = Storage::disk('mail_attachments')->get($filename);
        $mime = Storage::disk('mail_attachments')->mimeType('mail_attachments/'.$filename);
        ob_end_clean();
        return response($contents)
            ->header('Content-Type', $mime);
    }
}