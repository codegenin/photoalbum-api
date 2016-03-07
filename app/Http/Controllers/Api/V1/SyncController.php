<?php

namespace App\Http\Controllers\Api\V1;

use App\Album;
use App\Http\Controllers\Controller;
use App\Picture;
use Illuminate\Http\Request;

class SyncController extends Controller
{

    public function sync(Request $request)
    {
        $lastSync = $request->get('last_sync', 0);
        $now = time();
        $pictures = [];

        $albums = Album::with('cover_picture', 'user')
            ->where(function ($query) {
                $query->where('user_id', auth()->user()->id)
                    ->orWhere('is_public', 1);
            })
            ->where('updated_at', '>', date('Y-m-d H:i:s', $lastSync))
            ->get();

        if ($albums) {
            $pictures = Picture::where('updated_at', '>', date('Y-m-d H:i:s', $lastSync))
                ->whereIn('album_id', $albums->lists('id')->toArray())
                ->get();
        }

        return response()->json([
            'albums' => $albums,
            'pictures' => $pictures,
            'last_sync' => $now,
        ]);
    }

}
