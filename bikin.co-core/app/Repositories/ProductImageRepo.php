<?php


namespace App\Repositories;

use App\Http\Models\ProductImage;

class ProductImageRepo
{
    private $productImage;

    public function __construct()
    {
        $this->productImage = new ProductImage;
    }

    public function create($data)
    {
        return $this->productImage->save($data);
    }

    public function update($id, $data)
    {
        $a = $this->productImage->create($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->productImage->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->productImage->get();
    }

    public function filter($name, $param)
    {
        $a = $this->productImage->where($name, $param);


        return $a->get();
    }
}
