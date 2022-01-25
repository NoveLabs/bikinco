<?php


namespace App\Services;

use App\Repositories\OrderRepo;
use App\Repositories\OrderItemRepo;
use App\Repositories\OrderItemAccessoriesRepo;
use App\Repositories\OrderItemAdjPriceRepo;
use App\Repositories\OrderItemArtworkRepo;
use App\Repositories\OrderItemCustArtworkRepo;
use App\Repositories\OrderItemDesignRepo;
use App\Repositories\OrderItemSizeRepo;
use App\Repositories\OrderItemMaterialRepo;

class OrderService
{
    private $o;
    private $oi;
    private $oia;
    private $oiap;
    private $oiar;
    private $oica;
    private $oid;
    private $ois;
    private $oim;

    public function __construct()
    {
        $this->o = new OrderRepo;
        $this->oi = new OrderItemRepo;
        $this->oia = new OrderItemAccessoriesRepo;
        $this->oiap = new OrderItemAdjPriceRepo;
        $this->oiar = new OrderItemArtworkRepo;
        $this->oica = new OrderItemCustArtworkRepo;
        $this->oid = new OrderItemDesignRepo;
        $this->ois = new OrderItemSizeRepo;
        $this->oim = new OrderItemMaterialRepo;
    }

    public function createOrder($data)
    {
        return $this->o->create($data);
    }

    public function updateOrder($id, $data)
    {
        return $this->o->update($id, $data);
    }

    public function deleteOrder($id)
    {
        return $this->o->delete($id);
    }

    public function getAllOrders()
    {
        return $this->o->get();
    }

    public function filterOrdersWhere($name, $param)
    {
        return $this->o->filter($name, $param);
    }

    // Order Item
    public function createItem($data)
    {
        return $this->oi->create($data);
    }

    public function updateItem($id, $data)
    {
        return $this->oi->update($id, $data);
    }

    public function deleteItem($id)
    {
        return $this->oi->delete($id);
    }

    public function getAllItems()
    {
        return $this->oi->get();
    }

    public function filterItemsWhere($name, $param)
    {
        return $this->oi->filter($name, $param);
    }

    // Order Item Accessories
    public function createAccessories($data)
    {
        return $this->oia->create($data);
    }

    public function updateAccessories($id, $data)
    {
        return $this->oia->update($id, $data);
    }

    public function deleteAccessories($id)
    {
        return $this->oia->delete($id);
    }

    public function getAllAccessories()
    {
        return $this->oia->get();
    }

    public function filterAccessoriesWhere($name, $param)
    {
        return $this->oia->filter($name, $param);
    }

    public function sumAccessories($name)
    {
        return $this->oia->sum($name);
    }

    // Order Item Adj Price
    public function createAdjPrice($data)
    {
        return $this->oiap->create($data);
    }

    public function updateAdjPrice($id, $data)
    {
        return $this->oiap->update($id, $data);
    }

    public function deleteAdjPrice($id)
    {
        return $this->oiap->delete($id);
    }

    public function getAllAdjPrices()
    {
        return $this->oiap->get();
    }

    public function filterAdjPricesWhere($name, $param)
    {
        return $this->oiap->filter($name, $param);
    }

    public function sumAdjPrice($name)
    {
        return $this->oiap->sum($name);
    }

    // Order Item Artworks
    public function createArtwork($data)
    {
        return $this->oiar->create($data);
    }

    public function updateArtwork($id, $data)
    {
        return $this->oiar->update($id, $data);
    }

    public function deleteArtwork($id)
    {
        return $this->oiar->delete($id);
    }

    public function getAllArtworks()
    {
        return $this->oiar->get();
    }

    public function filterArtworksWhere($name, $param)
    {
        return $this->oiar->filter($name, $param);
    }

    public function sumArtworks($name)
    {
        return $this->oiar->sum($name);
    }

    // Order Item Cust Artwork
    public function createCustArtwork($data)
    {
        return $this->oica->create($data);
    }

    public function updateCustArtwork($id, $data)
    {
        return $this->oica->update($id, $data);
    }

    public function deleteCustArtwork($id)
    {
        return $this->oica->delete($id);
    }

    public function getAllCustArtworks()
    {
        return $this->oica->get();
    }

    public function filterCustArtworksWhere($name, $param)
    {
        return $this->oica->filter($name, $param);
    }

    public function sumCustArtworks($name)
    {
        return $this->oica->sum($name);
    }

    // Order Item Design
    public function createDesign($data)
    {
        return $this->oid->create($data);
    }

    public function updateDesign($id, $data)
    {
        return $this->oid->update($id, $data);
    }

    public function deleteDesign($id)
    {
        return $this->oid->delete($id);
    }

    public function getAllDesigns()
    {
        return $this->oid->get();
    }

    public function filterDesignsWhere($name, $param)
    {
        return $this->oid->filter($name, $param);
    }

    public function sumDesign($name)
    {
        return $this->oid->sum($name);
    }

    // Order Item Size
    public function createSize($data)
    {
        return $this->ois->create($data);
    }

    public function updateSize($id, $data)
    {
        return $this->ois->update($id, $data);
    }

    public function deleteSize($id)
    {
        return $this->ois->delete($id);
    }

    public function getAllSizes()
    {
        return $this->ois->get();
    }

    public function filterSizesWhere($name, $param)
    {
        return $this->ois->filter($name, $param);
    }

    public function sumSizes($name)
    {
        return $this->ois->sum($name);
    }

    // Order Item Material
    public function createMaterial($data)
    {
        return $this->oim->create($data);
    }

    public function updateMaterial($id, $data)
    {
        return $this->oim->update($id, $data);
    }

    public function deleteMaterial($id)
    {
        return $this->oim->delete($id);
    }

    public function getAllMaterials()
    {
        return $this->oim->get();
    }

    public function filterMaterialsWhere($name, $param)
    {
        return $this->oim->filter($name, $param);
    }

    public function sumMaterial($name)
    {
        return $this->oim->sum($name);
    }
    public function getDataInvoice($id)
    {
        $query = $this->o->invoicePayments($id);

        return $query;
    }
}

