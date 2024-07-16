<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Catalogo\Category;
use App\Models\Catalogo\GlobalAttribute;
use App\Models\Catalogo\Product as CatalogoProduct;
use App\Models\Catalogo\Provider as CatalogoProvider;
use App\Models\Settings;
use Exception;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class ProductosImportacion extends Component
{
    use WithPagination;

    public $category;

    public $nombre, $proveedor, $color, $precioMax, $precioMin, $stockMax, $stockMin, $orderStock = '', $orderPrice = '';
    public $search;

    public $settings = [];

    public function __construct()
    {
        $utilidad = (float) config('settings.utility');
        $price = DB::connection('mysql_catalogo')->table('products')->max('price');
        $this->precioMax = round($price + $price * ($utilidad / 100), 2);
        $this->precioMin = 0;
        $stock = DB::connection('mysql_catalogo')->table('products')->max('stock');
        $this->stockMax = $stock;
        $this->stockMin = 0;
    }

    public function mount()
    {
        $this->nombre = Session::get('busqueda', '');
        $this->color = '';
    
    

        // Setear a los valores de porveedores en settings
        $providerSeleccionados = Settings::where('slug', 'providers')->first();
        $providerSeleccionados = trim($providerSeleccionados->value) == '' ? [] : explode(',', trim($providerSeleccionados->value));
        $this->settings['providers'] = $providerSeleccionados;
        $utilidad = (float) config('settings.utility');

        $price = DB::connection('mysql_catalogo')->table('products')->max('price');
        $this->precioMax = round($price + $price * ($utilidad / 100), 2);
        $this->precioMin = 0;
        $stock = DB::connection('mysql_catalogo')->table('products')->max('stock');
        $this->stockMax = $stock;
        $this->stockMin = 0;
    }

    public function render()
    {
        $utilidad = (float) config('settings.utility');

        // Agrupar Colores similares
        $price = DB::connection('mysql_catalogo')->table('products')->max('price');
        $price = round($price + $price * ($utilidad / 100), 2);
        $stock = DB::connection('mysql_catalogo')->table('products')->max('stock');
        $nombre = '%' . $this->nombre . '%';
        $color = $this->color;
        $category = $this->category;
        $precioMax = $price;
        if ($this->precioMax != null) {
            $precioMax = $this->precioMax;
        }
        $precioMin = 0;
        if ($this->precioMin != null) {
            $precioMin = $this->precioMin;
        }
        $stockMax =  $this->stockMax;
        $stockMin =  $this->stockMin;
        if ($stockMax == null) {
            $stockMax = $stock;
        }
    
        if ($stockMin == null) {
            $stockMin = 0;
        }
        $categories = Category::withCount('productCategories')
            ->orderBy('product_categories_count', 'DESC')
            ->where('family', 'not like', '%textil%')
            ->limit(8)
            ->get();
    
        $products = CatalogoProduct::leftjoin('product_category', 'product_category.product_id', 'products.id')
            ->leftjoin('categories', 'product_category.category_id', 'categories.id')
            ->leftjoin('colors', 'products.color_id', 'colors.id')
            ->where('products.visible', '=', true)
            ->where('products.price', '>', 0)
            ->whereIn('products.provider_id', 13)
            ->whereBetween('products.price', [$precioMin, $precioMax])
            ->whereBetween('products.stock', [$stockMin, $stockMax])
            ->whereIn('products.type_id', [1])
            ->when($color !== '' && $color !== null, function ($query) use ($color) {
                $newColor  = '%' . $color . '%';
                $query->where('colors.color', 'LIKE', $newColor);
            })
            ->when($category !== '' && $category !== null, function ($query) use ($category) {
                $query->where(function ($query) use ($category) {
                    $query->where('categories.id', $category);
                });
            }, function ($query) {
                // Si no se proporciona una categoría, no aplicamos ningún filtro de categoría
            })
            ->when($nombre !== '' && $nombre !== null, function ($query) use ($nombre) {
                $query->where(function ($query) use ($nombre) {
                    $query->where('products.name', 'LIKE', '%' . $nombre . '%')
                        ->orWhere('products.description', 'LIKE', '%' . $nombre . '%');
                });
            })
            ->select('products.*')
            ->paginate(32);
    
        return view('livewire.productos-importacion', [
            'products' => $products,
            'categories' => $categories,
            'utilidad' => $utilidad,
            'price' => $price,
            'priceMax' => $precioMax,
            'priceMin' => $precioMin,
            'stock' => $stock,
            'stockMax' => $stockMax,
            'stockMin' => $stockMin,
        ]);
    }

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    public function updated()
    {
        Session::put('busqueda', $this->nombre);
        Session::put('category', $this->category);
        Session::put('color', $this->color);

        $this->resetPage();
    }

    public function limpiar()
    {
        $this->nombre = '';
        $this->color = '';
        $this->category = '';
        $this->proveedor = null;
        $this->orderPrice = '';
        $this->orderStock = '';
        $this->precioMin = 0;
        $this->stockMin = 0;
        
    }

    public function changeCategory($category_id)
    {
        $this->category = $this->category == $category_id ? null : $category_id;
        Session::put('category', $this->category);
    }

}
