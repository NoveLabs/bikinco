<?php

namespace App\Repositories;

use App\Http\Models\Category;

class CategoryRepo
{
    private $category;

    public function __construct()
    {
        $this->category = new Category;
    }

    public function save($data)
    {
        return $this->category->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->category->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->category->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->category->get();
    }

    public function filter($name, $param)
    {
        $a = $this->category->where($name, $param);


        return $a->get();
    }
}
