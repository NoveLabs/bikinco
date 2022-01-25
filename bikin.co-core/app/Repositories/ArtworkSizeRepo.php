<?php

namespace App\Repositories;

use App\Http\Models\ArtworkSize;

class ArtworkSizeRepo
{
    private $artworkSize;

    public function __construct()
    {
        $this->artworkSize = new ArtworkSize;
    }

    public function save($data)
    {
        return $this->artworkSize->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->artworkSize->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->artworkSize->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->artworkSize->get();
    }

    public function filter($name, $param)
    {
        return $this->artworkSize->where($name, $param)->get();
    }
}
