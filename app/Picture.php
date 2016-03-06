<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function setAsAlbumCover()
    {
        $this->album()->update([
            'cover_picture_id' => $this->id,
        ]);
    }

    public static function boot()
    {
        self::created(function ($picture) {
            if (!$picture->album->cover_picture_id) {
                $picture->setAsAlbumCover();
            }
        });
    }
}
