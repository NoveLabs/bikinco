<?php


namespace App\Repositories;

use App\Http\Models\ProductAddon;

class ProductAddonRepo
{
    private $pa;

    public function __construct()
    {
        $this->pa = new ProductAddon;
    }

    public function create($data)
    {
        return $this->pa->create($data);
    }

    public function update($id, $data)
    {
        $b = $this->pa->find($id);


        return $b->update($data);
    }

    public function delete($id)
    {
        $b = $this->pa->find($id);


        return $b->delete();
    }

    public function get()
    {
        return $this->pa->get();
    }

    public function filter($name, $param)
    {
        $b = $this->pa->where($name, $param);


        return $b->get();
    }

}
