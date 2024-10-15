<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Catalogo\GlobalAttribute;
use App\Models\Catalogo\Product as CatalogoProduct;
use App\Models\Catalogo\Provider as CatalogoProvider;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\Catalogo\Product;
use Illuminate\Support\Facades\Session;

class ProductosImportacionMinComponent extends Component
{

    use WithPagination;
    public $category;

    protected $paginationTheme = 'bootstrap';

    public $producto = '';
    public $nombre, $proveedor, $color, $precioMax, $precioMin, $stockMax, $stockMin, $orderStock = '', $orderPrice = '';
    public $search;
    protected $listeners = ['addProductNewQuote' => 'regresar'];


    public function mount()
    {
        $this->nombre = Session::get('busqueda', '');
        $this->color = '';


        // Setear a los valores de porveedores en settings
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
        $nombre = '%' . $this->nombre . '%';

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

        $products  = CatalogoProduct::where('name', 'LIKE', $nombre)->where('visible', true)
            ->where('products.visible', '=', true)
            ->whereIn('products.type_id', [1, 2])
            ->where('products.provider_id', 13)

            ->when($color !== '' && $color !== null, function ($query) use ($color) {
                $newColor  = '%' . $color . '%';
                $query->where('colors.color', 'LIKE', $newColor);
            })
            ->paginate(15);

        return view('livewire.productos-importacion-min-component', [
            'products' => $products,
            'utilidad' => $utilidad,
        ]);
    }
    public function seleccionarProducto(Product $product)
    {
        if ($product->provider_id == 5) {
            $cliente = new \nusoap_client('http://srv-datos.dyndns.info/doblevela/service.asmx?wsdl', 'wsdl');
            $error = $cliente->getError();
            if ($error) {
                echo 'Error' . $error;
            }
            //agregamos los parametros, en este caso solo es la llave de acceso
            $parametros = array('Key' => 't5jRODOUUIoytCPPk2Nd6Q==', 'codigo' => $product->sku_parent);
            //hacemos el llamado del metodo
            $resultado = $cliente->call('GetExistencia', $parametros);
            $msg = '';
            if (array_key_exists('GetExistenciaResult', $resultado)) {
                $informacionExistencias = json_decode(utf8_encode($resultado['GetExistenciaResult']))->Resultado;
                if (count($informacionExistencias) > 1) {
                    foreach ($informacionExistencias as $productExistencia) {
                        if ($product->sku == $productExistencia->CLAVE) {
                            $product->stock = $productExistencia->EXISTENCIAS;
                            $product->save();
                            break;
                        }
                        $msg = "Este producto no se encuentra en el catalogo que esta enviado DV via Servicio WEB";
                    }
                } else {
                    $msg = "Este producto no se encuentra en el catalogo que esta enviado DV via Servicio WEB";
                }
            } else {
                $msg = "No se obtuvo informacion acerca del Stock de este producto. Es posible que los datos sean incorrectos";
            }
        }
        $this->producto = $product;
    }

    public function regresar()
    {
        $this->producto = '';
    }
}
