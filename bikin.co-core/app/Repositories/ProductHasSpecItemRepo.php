<?php


namespace App\Repositories;

use App\Http\Models\ProductHasSpecificationItem as Phsi;

class ProductHasSpecItemRepo
{
    private $phsi;

    public function __construct()
    {
        $this->phsi = new Phsi;
    }

    public function create($data)
    {
        return $this->phsi->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->phsi->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->phsi->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->phsi->get();
    }

    public function filter($name, $param)
    {
        $a = $this->phsi->where($name, $param);


        return $a->get();
    }
}
