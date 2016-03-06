<?php

namespace App\Http\Controllers\Api\V1;

use App\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAlbumRequest;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Album::with('cover_picture', 'user')->where(function ($query) {
            $query->where('user_id', auth()->user()->id)
                ->orWhere('is_public', 1);
        })->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAlbumRequest $request)
    {
        $data = $request->all();
        $album = $this->user->albums()->create($data);
        return response()->json($album->load('cover_picture', 'user'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Album $albums)
    {
        return $albums->load('cover_picture', 'user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $albums)
    {
        $data = $request->all();
        $albums->update($data);
        return $this->show($albums);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $albums)
    {
        $albums->delete();
        return response()->json($albums, 204);
    }

    public function __construct()
    {
        parent::__construct();
        $this->middleware('albums', ['only' => ['show', 'update', 'destroy']]);
    }
}
