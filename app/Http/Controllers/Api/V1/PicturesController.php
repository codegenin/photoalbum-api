<?php

namespace App\Http\Controllers\Api\V1;

use App\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePictureRequest;
use App\Picture;
use App\Repositories\PictureRepository;
use Illuminate\Http\Request;

class PicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Album $albums)
    {
        return $albums->pictures;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePictureRequest $request, Album $albums)
    {
        $data = $request->all();
        $fileData = PictureRepository::processPictureFromRequest($request);
        $data = array_merge($data, $fileData);
        $picture = $albums->pictures()->create($data);
        return response()->json($picture, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Album $albums, Picture $pictures)
    {
        return $pictures;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $albums, Picture $pictures)
    {
        $data = $request->all();
        $pictures->update($data);
        return $this->show($pictures);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album, Picture $pictures)
    {
        $pictures->delete();
        return response()->json($pictures, 204);
    }

    public function __construct()
    {
        parent::__construct();
        $this->middleware('pictures');
    }
}
