<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helper
{

    public static function UploadBase64($base64String, $directory)
    {
        self::deleteAllImagesInDirectory($directory);

        $image = self::base64ToUploadedFile($base64String);

        $path = $image->store($directory);

        return "/storage/{$path}";
    }
    public static function base64ToUploadedFile($base64String)
    {
        // Extract image data
        $imageData = explode(',', $base64String);
        $imageContent = base64_decode($imageData[1]);

        // Determine file extension
        $mimeType = explode(':', explode(';', $imageData[0])[0])[1];
        $extension = explode('/', $mimeType)[1];

        // Create a unique filename
        $filename = Str::random(40) . '.' . $extension;

        // Store the file in Laravel's temporary directory
        if (! File::exists(storage_path('app/temp'))) {
            File::makeDirectory(storage_path('app/temp'), 0777, true);
        }

        $tempPath = storage_path('app/temp/' . $filename);
        file_put_contents($tempPath, $imageContent);

        // Create UploadedFile instance
        return new UploadedFile(
            $tempPath,
            $filename,
            $mimeType,
            null,
            true // Keep the original file
        );
    }

    public static function isBase64Image($string)
    {
        return preg_match('/^data:image\/(png|jpe?g|gif|webp);base64,/', $string);
    }

    public static function deleteAllImagesInDirectory(string $directory)
    {
        $files = Storage::disk('public')->files($directory);

        if (empty($files)) {
            return false; // No files found
        }

        return Storage::disk('public')->delete($files);
    }

    public static function cleanTempFiles()
    {
        $tempPath = storage_path('app/temp');
        if (file_exists($tempPath)) {
            array_map('unlink', glob("$tempPath/*"));
        }
    }
}
