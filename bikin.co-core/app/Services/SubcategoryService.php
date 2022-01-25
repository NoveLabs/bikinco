<?php


namespace App\Services;

use App\Repositories\SubcategoryRepo;

class SubcategoryService
{
    private $sr;

    public function __construct()
    {
        $this->sr = new SubcategoryRepo;
    }

    public function createSubcat($data)
    {
        return $this->sr->create($data);
    }

    public function updateSubcat($id, $data)
    {
        return $this->sr->update($id, $data);
    }

    public function deleteSubcat($id)
    {
        return $this->sr->delete($id);
    }

    public function getAllSubcats()
    {
        return $this->sr->get();
    }

    public function filterSubcatsWhere($name, $param)
    {
        return $this->sr->filter($name, $param);
    }
}
