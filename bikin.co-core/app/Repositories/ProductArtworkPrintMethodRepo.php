<?php


namespace App\Repositories;

use App\Http\Models\ProductArtworkPrintMethod as Parm;

class ProductArtworkPrintMethodRepo
{
    private $parm;

    public function __construct()
    {
        $this->parm = new Parm;
    }

    public function save($data)
    {
        return $this->parm->save($data);
    }

    public function update($id, $data)
    {
        $a = $this->parm->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->parm->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->parm->get();
    }

    public function filter($name, $param)
    {
        $a = $this->parm->where($name, $param);


        return $a->get();
    }
}
