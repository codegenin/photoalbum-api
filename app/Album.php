<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name',
        'cover_picture_id',
        'is_public',
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function cover_picture()
    {
        return $this->belongsTo(Picture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
