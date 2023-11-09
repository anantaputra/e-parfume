<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public static function uploadFile($file, $path)
    {
        if($file) {
            $filePath = Storage::disk('public')->put($path, $file);

            return $filePath;
        }

        return null;
    }
}
