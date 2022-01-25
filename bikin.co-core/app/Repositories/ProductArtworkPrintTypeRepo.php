<?php


namespace App\Repositories;

use App\Http\Models\ProductArtworkPrintType as Part;

class ProductArtworkPrintTypeRepo
{
    private $part;

    public function __construct()
    {
        $this->part = new Part;
    }

    public function save($data)
    {
        return $this->part->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->part->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->part->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->part->get();
    }

    public function filter($name, $param)
    {
        $a = $this->part->where($name, $param);


        return $a->get();
    }
}
