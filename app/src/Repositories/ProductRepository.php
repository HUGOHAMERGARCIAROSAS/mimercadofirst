<?php

namespace App\src\Repositories;

use App\src\Models\Product;
use App\src\Repositories\Base\BaseRepository;
use App\src\Util\Constants;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB as DB;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function productsWithProductToday($numeroDeRegistros)
    {
        return $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('product_today', 1)
            ->where('disponible', 'SI')
            ->orderByRaw('ISNULL(product.orden), product.orden ASC')
            ->get();
    }

    public function listProductsInOrderDatatable($order = 'id', $sort = 'desc', $except = [])
    {
        return $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->orderByRaw('ISNULL(product.orden), product.orden ASC');

    }

    public function listProductsInOrderWeb($order = 'id', $sort = 'desc', $except = []): Collection
    {
        return $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('disponible', 'SI')
            ->orderByRaw('ISNULL(product.orden), product.orden ASC')
            ->get();
    }

    public function listProductsInOrderWebByProductSubCategory($productSubCategoryId): Collection
    {
        $except = [];

        $productWithOrder = $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('disponible', 'SI')
            ->where('product_sub_category_id', $productSubCategoryId)
            ->where('orden', '<>', null)
            ->orderBy('orden', 'asc')
            ->get()->except($except);

        $productWithWithoutOrder = $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('product_sub_category_id', $productSubCategoryId)
            ->where('disponible', 'SI')
            ->orderBy('id', 'desc')
            ->get()->except($except);

        return $productWithOrder->merge($productWithWithoutOrder);
    }

    public function listProductsInOrderWebBySubCategory($subCategoryId): Collection
    {
        $except = [];

        $products = $this->model
            ->whereHas('productSubCategory', function ($q) use ($subCategoryId) {
                $q->whereHas('subCategory', function ($sub) use ($subCategoryId) {
                    $sub->where('id', $subCategoryId);
                });
            })
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('disponible', 'SI')
            ->orderByRaw('ISNULL(product.orden), product.orden ASC')
            ->get();

        return $products;
    }

    public function listProductsInOrderWebByCategory($categoryId): Collection
    {
        $except = [];

        $products = $this->model
            ->whereHas('productSubCategory', function ($q) use ($categoryId) {
                $q->whereHas('subCategory', function ($sub) use ($categoryId) {
                    $sub->whereHas('category', function ($cat) use ($categoryId) {
                        $cat->where('id', $categoryId);
                    });
                });
            })
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('disponible', 'SI')
            ->orderByRaw('ISNULL(product.orden), product.orden ASC')
            ->get();

        return $products;
    }

    public function listProductsWithOrderWebByCategoryAdmin($order = 'id', $sort = 'desc', $categoryId): Collection
    {
        $except = [];

        $productWithOrder = $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('category_id', $categoryId)
            ->where('orden', '<>', null)
            ->orderBy('orden', 'asc')->get()->except($except);

        $productWithWithoutOrder = $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('category_id', $categoryId)
            ->orderBy('id', 'desc')->get()->except($except);

        return $productWithOrder->merge($productWithWithoutOrder);
    }

    public function listProductsOrden($except = []): Collection
    {
        return $this->model->where->orderBy('id','ASC')->get()->except($except);
    }

    public function searchProduct($text): Collection
    {
        if (!empty($text)) {
            return $this->model->searchProduct($text);
        } else {
            return $this->listProductsInOrderWeb();
        }
    }

    public function updateItemInIndex($column, $value)
    {
        return $this->model
            ->update([
                $column => $value
            ]);
    }

    public function totalProducts()
    {
        return $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->count();
    }

    public function totalProductForCreate()
    {
        return ($this->totalProducts()) + 1;
    }

    public function organizeProductsByDefault()
    {
        $products = $this->allWithEstateActive();

        foreach ($products as $index => $product) {
            $product->update([
                'orden' => $index + 1
            ]);
        }
    }

    public function organizeProductsInCreate($order)
    {
        $products = $this->model
            ->orderBy('orden', 'ASC')
            ->where('orden', '>=', $order)
            ->select('id', 'orden')
            ->get();

        $orderUpdate = ($order + 1);
        foreach ($products as $product) {
            $product->update([
                'orden' => $orderUpdate,
            ]);
            $orderUpdate++;
        }
    }

    public function organizeProductsInUpdate($newPosition, $positionActual)
    {
        $firstPosition = 1;
        if ($positionActual == $firstPosition) {
            $products = $this->model
                ->orderBy('orden', 'ASC')
                ->where('orden', '>', $positionActual)
                ->where('orden', '<=', $newPosition)
                ->get();

            foreach ($products as $index => $product) {
                $product->update([
                    'orden' => $product->orden - 1,
                ]);
            }
        } else {
            $products = $this->model
                ->orderBy('orden', 'ASC')
                ->where('orden', '>=', $newPosition)
                ->where('orden', '<', $positionActual)
                ->get();

            foreach ($products as $index => $product) {
                $product->update([
                    'orden' => $product->orden + 1,
                ]);
            }
        }

    }

    public function organizeProductsInDelete($orderOfProductToDelete)
    {
        $products = $this->model
            ->where('orden', '>', $orderOfProductToDelete)
            ->orderBy('orden', 'ASC')
            ->select('orden', 'id')
            ->get();

        foreach ($products as $index => $product) {

            $product->update([
                'orden' => $product->orden - 1,
            ]);
        }
    }

    public function delete(): bool
    {
        return $this->model->update([
            'state' => Constants::ESTADO_ELIMINADO,
            'orden' => null,
        ]);
    }

    public function listProductByOrder()
    {
        return $this->model
            ->orderBy('orden', 'ASC')
            ->where('state', Constants::ESTADO_ACTIVO)
            ->get();
    }
}