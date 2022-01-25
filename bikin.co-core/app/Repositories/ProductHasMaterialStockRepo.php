<?php


namespace App\Repositories;

use App\Http\Models\ProductHasMaterialStock as Phms;

class ProductHasMaterialStockRepo
{
    private $data;

    public function __construct()
    {
        $this->data = new Phms;
    }

    public function create($data)
    {
        return $this->data->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->data->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->data->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->data->get();
    }

    public function filter($name, $param)
    {
        $a = $this->data->where($name, $param);


        return $a->get();
    }
}
