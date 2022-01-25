<?php

namespace App\Services;

use App\Repositories\ArtworkRepo as Artwork;
use App\Repositories\ArtworkSizeRepo as ArtworkSize;

class ArtworkService
{
    // Private Variables
    private $artwork;
    private $artworkSize;

    public function __construct()
    {
        $this->artwork = new Artwork;
        $this->artworkSize = new ArtworkSize;
    }

    public function createArtwork($data)
    {
        return $this->artwork->save($data);
    }

    public function updateArtwork($id, $data)
    {
        return $this->artwork->update($id, $data);
    }

    public function deleteArtwork($id)
    {
        return $this->artwork->delete($id);
    }

    public function getAllArtworks()
    {
        return $this->artwork->get();
    }

    public function filterArtworkBy($name, $param)
    {
        return $this->artwork->filter($name, $param);
    }


    // Artwork Size
    public function createArtworkSize($data)
    {
        return $this->artworkSize->save($data);
    }

    public function updateArtworkSize($id, $data)
    {
        return $this->artworkSize->update($id, $data);
    }

    public function deleteArtworkSize($id)
    {
        return $this->artworkSize->delete($id);
    }

    public function getAllArtworkSizes()
    {
        return $this->artworkSize->get();
    }

    public function filterArtworkSizeBy($name, $param)
    {
        return $this->artworkSize->filter($name, $param);
    }
}
