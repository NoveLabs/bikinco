<?php


namespace App\Repositories;

use App\Http\Models\ProductAddonImage;

class ProductAddonImageRepo
{
    private $pai;

    public function __construct()
    {
        $this->pai = new ProductAddonImage;
    }

    public function save($data)
    {
        return $this->pai->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->pai->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->pai->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->pai->get();
    }

    public function filter($name, $param)
    {
        $a = $this->pai->where($name, $param);


        return $a->get();
    }
}
