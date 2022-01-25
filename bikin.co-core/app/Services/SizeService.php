<?php


namespace App\Services;

use App\Repositories\SizeRepo as S;
use App\Repositories\SizeTypeRepo as St;
use App\Repositories\SizepackRepo as Sp;

class SizeService
{
    private $s;
    private $st;
    private $sp;

    public function __construct()
    {
        $this->s = new S;
        $this->sp = new Sp;
        $this->st = new St;
    }

    // Size
    public function createSize($data)
    {
        return $this->s->create($data);
    }

    public function updateSize($id, $data)
    {
        return $this->s->update($id, $data);
    }

    public function deleteSize($id)
    {
        return $this->s->delete($id);
    }

    public function getAllSizes()
    {
        return $this->s->get();
    }

    public function filterSizesWhere($name, $param)
    {
        return $this->s->filter($name, $param);
    }

    // Size types
    public function createSizeType($data)
    {
        return $this->st->create($data);
    }

    public function updateSizeType($id, $data)
    {
        return $this->st->update($id, $data);
    }

    public function deleteSizeType($id)
    {
        return $this->st->delete($id);
    }

    public function getAllSizeTypes()
    {
        return $this->st->get();
    }

    public function filterSizeTypesWhere($name, $param)
    {
        return $this->st->filter($name, $param);
    }

    // Sizepack
    public function createSizepack($data)
    {
        return $this->sp->create($data);
    }

    public function updateSizepack($id, $data)
    {
        return $this->sp->update($id, $data);
    }

    public function deleteSizepack($id)
    {
        return $this->sp->delete($id);
    }

    public function getAllSizepacks()
    {
        return $this->sp->get();
    }

    public function filterSizepacksWhere($name, $param)
    {
        return $this->sp->filter($name, $param);
    }
}
