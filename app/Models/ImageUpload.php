<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageUpload extends Model
{
    use HasFactory;

    public static function toStorage($data){

        $image = $data['photo'];
        $path = 'public/'.$data["destination"].'_photos/';

        $file_type = explode(':image/', substr($image, 0, strpos($image, ';')))[1]; 
        $file_name = time().'.'.$file_type;
        $file = str_replace('', '+', str_replace('data:image/'.$file_type.';base64,', '', $image));
        Storage::disk('local')->put($path . $file_name, base64_decode($file));
        return $file_name;
    }
}
