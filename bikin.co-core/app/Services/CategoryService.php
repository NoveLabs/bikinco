<?php

namespace App\Services;

use App\Repositories\CategoryRepo as Category;

class CategoryService
{
    private $category;

    public function __construct()
    {
        $this->category = new Category;
    }

    public function createCategory($data)
    {
        return $this->category->save($data);
    }

    public function updateCategory($id, $data)
    {
        return $this->category->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->category->delete($id);
    }

    public function getAllCategories()
    {
        return $this->category->get();
    }

    public function filterCategoriesWhere($name, $param)
    {
        return $this->category->filter($name, $param);
    }
}
