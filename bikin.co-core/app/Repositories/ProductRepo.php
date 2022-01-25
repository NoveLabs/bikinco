<?php


namespace App\Repositories;

use App\Http\Models\Product;

class ProductRepo
{
    private $product;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function create($data)
    {
        return $this->product->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->product->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->product->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->product->get();
    }

    public function filter($name, $param)
    {
        $a = $this->product->where($name, $param);


        return $a->get();
    }
}
