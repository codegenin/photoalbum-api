<?php

namespace App;

use App\Repositories\PictureRepository;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'name',
        'description',
        'size',
        'url',
        'thumb_url',
        'file_name',
        'file_path',
        'thumb_path',
        'lat',
        'lng',
    ];

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
        self::deleting(function ($picture) {
            PictureRepository::removeFiles($picture);
        });
    }
}
