<?php


namespace App\Repositories;

use App\Http\Models\ProductSpecificationItem as Psi;

class ProductSpecItemRepo
{
    private $psi;

    public function __construct()
    {
        $this->psi = new Psi;
    }

    public function create($data)
    {
        return $this->psi->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->psi->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->psi->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->psi->get();
    }

    public function filter($name, $param)
    {
        $a = $this->psi->where($name, $param);


        return $a->get();
    }
}
