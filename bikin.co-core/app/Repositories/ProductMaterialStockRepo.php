<?php


namespace App\Repositories;

use App\Http\Models\ProductMaterialStock as Pms;

class ProductMaterialStockRepo
{
    private $pms;

    public function __construct()
    {
        $this->pms = new Pms;
    }

    public function create($data)
    {
        return $this->pms->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->pms->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->pms->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->pms->get();
    }

    public function filter($name, $param)
    {
        $a = $this->pms->where($name, $param);


        return $a->get();
    }
}
