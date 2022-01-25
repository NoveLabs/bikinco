<?php


namespace App\Services;

use App\Repositories\ProductRepo;
use App\Repositories\ProductImageRepo;
use App\Repositories\ProductAddonRepo;
use App\Repositories\ProductAddonImageRepo;
use App\Repositories\ProductMaterialRepo;
use App\Repositories\ProductMaterialItemRepo;
use App\Repositories\ProductMaterialStockRepo;
use App\Repositories\ProductSpecRepo;
use App\Repositories\ProductSpecItemRepo;
use App\Repositories\ProductHasAddonRepo;
use App\Repositories\ProductHasMaterialStockRepo;
use App\Repositories\ProductArtworkPrintMethodRepo;
use App\Repositories\ProductArtworkPrintTypeRepo;
use App\Repositories\ProductHasSpecItemRepo;

class ProductService
{
    private $p;
    private $pi;
    private $pa;
    private $pai;
    private $pm;
    private $pmi;
    private $pms;
    private $ps;
    private $psi;
    private $pha;
    private $phms;
    private $papm;
    private $papt;
    private $phsi;

    public function __construct()
    {
        $this->p = new ProductRepo;
        $this->pi = new ProductImageRepo;
        $this->pa = new ProductAddonRepo;
        $this->pai = new ProductAddonImageRepo;
        $this->pm = new ProductMaterialRepo;
        $this->pmi = new ProductMaterialItemRepo;
        $this->pms = new ProductMaterialStockRepo;
        $this->ps = new ProductSpecRepo;
        $this->psi = new ProductSpecItemRepo;
        $this->pha = new ProductHasAddonRepo;
        $this->phms = new ProductHasMaterialStockRepo;
        $this->papm = new ProductArtworkPrintMethodRepo;
        $this->papt = new ProductArtworkPrintTypeRepo;
        $this->phsi = new ProductHasSpecItemRepo;
    }

    public function createProduct($data)
    {
        return $this->p->create($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->p->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->p->delete($id);
    }

    public function getAllProducts()
    {
        return $this->p->get();
    }

    public function filterProductsWhere($name, $param)
    {
        return $this->p->filter($name, $param);
    }

    // Product Image
    public function createProductImage($data)
    {
        return $this->pi->create($data);
    }

    public function updateProductImage($id, $data)
    {
        return $this->pi->update($id, $data);
    }

    public function deleteProductImage($id)
    {
        return $this->pi->delete($id);
    }

    public function getAllProductImages()
    {
        return $this->pi->get();
    }

    public function filterProductImagesWhere($name, $param)
    {
        return $this->pi->filter($name, $param);
    }

    // Product Addon
    public function createProductAddon($data)
    {
        return $this->pa->create($data);
    }

    public function updateProductAddon($id, $data)
    {
        return $this->pa->update($id, $data);
    }

    public function deleteProductAddon($id)
    {
        return $this->pa->delete($id);
    }

    public function getAllProductAddons()
    {
        return $this->pa->get();
    }

    public function filterProductAddonsWhere($name, $param)
    {
        return $this->pa->filter($name, $param);
    }

    // Product Addon Image
    public function createProductAddonImage($data)
    {
        return $this->pai->create($data);
    }

    public function updateProductAddonImage($id, $data)
    {
        return $this->pai->update($id, $data);
    }

    public function deleteProductAddonImage($id)
    {
        return $this->pai->delete($id);
    }

    public function getAllProductAddonImages()
    {
        return $this->pai->get();
    }

    public function filterProductAddonImagesWhere($name, $param)
    {
        return $this->pai->filter($name, $param);
    }

    // Product Material
    public function createProductMaterial($data)
    {
        return $this->pm->create($data);
    }

    public function updateProductMaterial($id, $data)
    {
        return $this->pm->update($id, $data);
    }

    public function deleteProductMaterial($id)
    {
        return $this->pm->delete($id);
    }

    public function getAllProductMaterials()
    {
        return $this->pm->get();
    }

    public function filterProductMaterialsWhere($name, $param)
    {
        return $this->pm->filter($name, $param);
    }

    // Product Material Item
    public function createProductMaterialItem($data)
    {
        return $this->pmi->create($data);
    }

    public function updateProductMaterialItem($id, $data)
    {
        return $this->pmi->update($id, $data);
    }

    public function deleteProductMaterialItem($id)
    {
        return $this->pmi->delete($id);
    }

    public function getAllProductMaterialItems()
    {
        return $this->pmi->get();
    }

    public function filterProductMaterialItemsWhere($name, $param)
    {
        return $this->pmi->filter($name, $param);
    }

    // Product Material Stock
    public function createProductMaterialStock($data)
    {
        return $this->pms->create($data);
    }

    public function updateProductMaterialStock($id, $data)
    {
        return $this->pms->update($id, $data);
    }

    public function deleteProductMaterialStock($id)
    {
        return $this->pms->delete($id);
    }

    public function getAllProductMaterialStocks()
    {
        return $this->pms->get();
    }

    public function filterProductMaterialStocksWhere($name, $param)
    {
        return $this->pms->filter($name, $param);
    }

    // Product Spec
    public function createProductSpec($data)
    {
        return $this->ps->create($data);
    }

    public function updateProductSpec($id, $data)
    {
        return $this->ps->update($id, $data);
    }

    public function deleteProductSpec($id)
    {
        return $this->ps->delete($id);
    }

    public function getAllProductSpecs()
    {
        return $this->ps->get();
    }

    public function filterProductSpecsWhere($name, $param)
    {
        return $this->ps->filter($name, $param);
    }

    // Product Spec Item
    public function createProductSpecItem($data)
    {
        return $this->psi->create($data);
    }

    public function updateProductSpecItem($id, $data)
    {
        return $this->psi->update($id, $data);
    }

    public function deleteProductSpecItem($id)
    {
        return $this->psi->delete($id);
    }

    public function getAllProductSpecItems()
    {
        return $this->psi->get();
    }

    public function filterProductSpecItemsWhere($name, $param)
    {
        return $this->psi->filter($name, $param);
    }

    // Product Has AddonRepo
    public function createProductHasAddon($data)
    {
        return $this->pha->create($data);
    }

    public function updateProductHasAddon($id, $data)
    {
        return $this->pha->update($id, $data);
    }

    public function deleteProductHasAddon($id)
    {
        return $this->pha->delete($id);
    }

    public function getAllProductHasAddons()
    {
        return $this->pha->get();
    }

    public function filterProductHasAddonsWhere($name, $param)
    {
        return $this->pha->filter($name, $param);
    }

    // Product Has Material Stock;
    public function createProductHasMaterialStock($data)
    {
        return $this->phms->create($data);
    }

    public function updateProductHasMaterialStock($id, $data)
    {
        return $this->phms->update($id, $data);
    }

    public function deleteProductHasMaterialStock($id)
    {
        return $this->phms->delete($id);
    }

    public function getAllProductHasMaterialStocks()
    {
        return $this->phms->get();
    }

    public function filterProductHasMaterialStocksWhere($name, $param)
    {
        return $this->phms->filter($name, $param);
    }

    // Print Methods
    public function createPrintMethod($data)
    {
        return $this->papm->save($data);
    }

    public function updatePrintMethod($id, $data)
    {
        return $this->papm->update($id, $data);
    }

    public function deletePrintMethod($id)
    {
        return $this->papm->delete($id);
    }

    public function getAllPrintMethods()
    {
        return $this->papm->get();
    }

    public function filterPrintMethodsWhere($name, $param)
    {
        return $this->papm->filter($name, $param);
    }

    // Print Type
    public function createPrintType($data)
    {
        return $this->papt->save($data);
    }

    public function updatePrintType($id, $data)
    {
        return $this->papt->update($id, $data);
    }

    public function deletePrintType($id)
    {
        return $this->papt->delete($id);
    }

    public function getAllPrintTypes()
    {
        return $this->papt->get();
    }

    public function filterPrintTypesWhere($name, $param)
    {
        return $this->papt->filter($name, $param);
    }

    // Has Spec Item
    public function createHasSpecItem($data)
    {
        return $this->phsi->create($data);
    }

    public function updateHasSpecItem($id, $data)
    {
        return $this->phsi->update($id, $data);
    }

    public function deleteHasSpecItem($id)
    {
        return $this->phsi->delete($id);
    }

    public function getAllHasSpecItems()
    {
        return $this->phsi->get();
    }

    public function filterHasSpecItemsWhere($name, $param)
    {
        return $this->phsi->filter($name, $param);
    }
}
