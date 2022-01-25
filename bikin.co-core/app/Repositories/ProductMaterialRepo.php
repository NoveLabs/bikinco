<?php


namespace App\Repositories;

use App\Http\Models\ProductMaterial as Pm;

class ProductMaterialRepo
{
    private $pm;

    public function __construct()
    {
        $this->pm = new Pm;
    }

    public function create($data)
    {
        return $this->pm->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->pm->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->pm->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->pm->get();
    }

    public function filter($name, $param)
    {
        $a = $this->pm->where($name, $param);


        return $a->get();
    }
}
