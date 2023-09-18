<?php

namespace App\Traits;

use Storage;
use Illuminate\Support\Str;

trait StoreImageTrait
{
    public function uploadImageToStorage($file, $foderName)
    {
        $filePath = Storage::disk('local')->put('public/' . $foderName, $file);
        $dataUpload = [
            'link' => Storage::url($filePath),
        ];

        return $dataUpload;
    }
}
