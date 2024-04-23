<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\UploadedFile;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public static function upload(UploadedFile $file, $folder = 'categories')
    {
        // Upload the image to Cloudinary
        return Cloudinary::upload($file->getRealPath(), [
            'folder' => $folder,
        ]);
    }
}
