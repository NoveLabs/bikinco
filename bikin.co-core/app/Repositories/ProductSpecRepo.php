<?php


namespace App\Repositories;

use App\Http\Models\ProductSpecification as Ps;

class ProductSpecRepo
{
    private $ps;

    public function __construct()
    {
        $this->ps = new Ps;
    }

    public function create($data)
    {
        return $this->ps->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->ps->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->ps->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->ps->get();
    }

    public function filter($name, $param)
    {
        $a = $this->ps->where($name, $param);


        return $a->get();
    }
}
