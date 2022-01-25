<?php

namespace App\Repositories;

use App\Http\Models\Artwork;
use App\Http\Models\ArtworkSize;

class ArtworkRepo
{
    private $artwork;

    public function __construct()
    {
        $this->artwork = new Artwork;
    }

    public function save($data)
    {
        return $this->artwork->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->artwork->find($id);

        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->artwork->find($id);

        return $a->delete();
    }

    public function get()
    {
        return $this->artwork->get();
    }

    public function filter($name, $param)
    {
        return $this->artwork->where($name, $param)->get();
    }

}
