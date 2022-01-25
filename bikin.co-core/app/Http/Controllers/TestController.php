<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ArtworkService as Artwork;

class TestController extends Controller
{
    private $artwork;

    public function __construct()
    {
        $this->artwork = new Artwork;
    }

    public function test()
    {
        return response()->json($this->artwork->getAllArtworks());
    }
}
