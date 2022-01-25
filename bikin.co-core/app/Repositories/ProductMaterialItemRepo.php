<?php


namespace App\Repositories;

use App\Http\Models\ProductMaterialItem as Pmi;

class ProductMaterialItemRepo
{
    private $pmi;

    public function __construct()
    {
        $this->pmi = new Pmi;
    }

    public function create($data)
    {
        return $this->pmi->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->pmi->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->pmi->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->pmi->get();
    }

    public function filter($name, $param)
    {
        $a = $this->pmi->where($name, $param);


        return $a->get();
    }
}
