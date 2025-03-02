<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageUpload;

class ImageUploadController extends Controller
{
    public function index(Request $request)
    {
        return ImageUpload::toStorage($request->all());
    }
}
