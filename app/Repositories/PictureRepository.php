<?php

namespace App\Repositories;

use App\Picture;
use Illuminate\Http\Request;
use Image;

class PictureRepository
{
    public static function processPictureFromRequest(Request $request)
    {
        $fs = app('files');
        $tempPath = self::getTodaysFolder() . str_random(48);
        if (($image = base64_decode($request->get('base64img'))) === false) {
            throw new \Exception("Invalid Image", 1);
        }

        $fs->put($tempPath, $image);
        $mime = $fs->mimeType($tempPath);
        switch ($mime) {
            case 'image/png':
                $extension = '.png';
                break;
            case 'image/jpeg':
                $extension = '.jpg';
                break;
            default:
                $fs->delete($tempPath);
                throw new \Exception("Invalid Image Format: " . $mime, 1);
                break;
        }
        $filePath = $tempPath . $extension;
        $thumbPath = $tempPath . '_thumb' . $extension;

        $fs->move($tempPath, $filePath);
        $fileName = $fs->name($filePath) . $extension;
        $thumbName = $fs->name($thumbPath) . $extension;
        $url = url('/uploads/' . date('Ymd') . '/' . $fileName);
        $thumbUrl = url('/uploads/' . date('Ymd') . '/' . $thumbName);

        $thumb = Image::make($filePath);
        $thumb->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $thumb->save($thumbPath);

        $size = $fs->size($filePath);

        return [
            'size' => $size,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'thumb_path' => $thumbPath,
            'url' => $url,
            'thumb_url' => $thumbUrl,
        ];
    }

    public static function removeFiles(Picture $picture)
    {
        $fs = app('files');
        $fs->delete($picture->file_path);
        $fs->delete($picture->thumb_path);
    }

    public static function getTodaysFolder()
    {
        $fs = app('files');
        $dir = public_path() . '/uploads/' . date('Ymd') . '/';
        if (!$fs->isDirectory($dir)) {
            $fs->makeDirectory($dir);
        }
        return $dir;
    }
}
