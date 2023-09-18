<?php
namespace App\Services;

use App\Models\Media;
use App\Traits\StoreImageTrait;

class MediaService
{
    use StoreImageTrait;

    public function handleStoreUpload($createdFilm, $request)
    {
        if ($request->hasFile('avatar')) {
            $avatarUpload = $this->uploadImageToStorage($request->file('avatar'), 'film');
            if (!empty($avatarUpload)) {
                Media::create([
                    "film_id" => $createdFilm->id,
                    "link" => $avatarUpload['link'],
                    "type" => "avatar",
                ]);
            }
        }
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $imageUpload = $this->uploadImageToStorage($image, 'film');
                if (!empty($imageUpload)) {
                    Media::create([
                        "film_id" => $createdFilm->id,
                        "link" => $imageUpload['link'],
                        "type" => "image",
                    ]);
                }
            }
        }
        if (isset($request->trailer)) {
            Media::create([
                "film_id" => $createdFilm->id,
                "link" => $request->trailer,
                "type" => "trailer",
            ]);
        }
    }

    public function handleUpdateUpload($updatedFilm, $request)
    {
        if ($request->hasFile('avatar')) {
            Media::where([
                'film_id' => $updatedFilm->id,
                'type' => 'avatar'
            ])->delete();
            $avatarUpload = $this->uploadImageToStorage($request->file('avatar'), 'film');
            if (!empty($avatarUpload)) {
                Media::create([
                    "film_id" => $updatedFilm->id,
                    "link" => $avatarUpload['link'],
                    "type" => "avatar",
                ]);
            }
        }
        if ($request->hasFile('images')) {
            Media::where([
                'film_id' => $updatedFilm->id,
                'type' => 'image'
            ])->delete();
            foreach ($request->images as $image) {
                $imageUpload = $this->uploadImageToStorage($image, 'film');
                if (!empty($imageUpload)) {
                    Media::create([
                        "film_id" => $updatedFilm->id,
                        "link" => $imageUpload['link'],
                        "type" => "image",
                    ]);
                }
            }
        }
        if (isset($request->trailer)) {
            Media::updateOrCreate([
                "film_id" => $updatedFilm->id,
                "type" => "trailer",
            ], [
                "film_id" => $updatedFilm->id,
                "link" => $request->trailer,
                "type" => "trailer",
            ]);
        }
    }
}
