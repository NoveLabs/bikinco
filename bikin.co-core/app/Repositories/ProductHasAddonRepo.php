<?php


namespace App\Repositories;

use App\Http\Models\ProductHasAddon as Pha;

class ProductHasAddonRepo
{
    private $pha;

    public function __construct()
    {
        $this->pha = new Pha;
    }

    public function save($data)
    {
        return $this->pha->create($data);
    }

    public function update($id, $data)
    {
        $a = $this->pha->find($id);


        return $a->update($data);
    }

    public function delete($id)
    {
        $a = $this->pha->find($id);


        return $a->delete();
    }

    public function get()
    {
        return $this->pha->get();
    }

    public function filter($name, $param)
    {
        $a = $this->pha->where($name, $param);


        return $a->get();
    }
}
