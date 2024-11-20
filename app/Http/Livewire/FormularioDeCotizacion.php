<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\Catalogo\GlobalAttribute;
use App\Models\Catalogo\Product;
use App\Models\CurrentQuotesTechniques;
use App\Models\Material;
use App\Models\MaterialTechnique;
use App\Models\PricesTechnique;
use App\Models\Size;
use App\Models\SizeMaterialTechnique;
use App\Models\Technique;
use App\Models\TemporalImageUrl;
use App\Models\UserLogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormularioDeCotizacion extends Component
{
    use WithFileUploads;

    public $product, $currentQuote, $productEdit, $currentQuote_id, $productNewAdd;
    public $tipoEnvio, $precioUnitarioEnvio =0, $totalCajas,$precioProductoCajas;
    public $precio=0, $precioCalculado, $precioTotal = 0;
    public $costoTotal, $costoCalculado = 0;

    public $tecnica = null, $colores = null, $operacion = null, $utilidad = 0, $entrega = null, $cantidad = null, $priceTechnique, $newPriceTechnique = null, $newDescription = null, $imageSelected;

    public $priceScales, $infoScales = [], $priceScalesComplete = [],  $cantidadEscala, $precioTecnicaEscala, $editScale = false, $itemEditScale = null;

    public $detalles, $embalaje, $armado, $destino;

    public $materialSeleccionado;
    public $tecnicaSeleccionada;
    public $sizeSeleccionado;
    public $precioDeTecnica;

    public $photo;

    protected $listeners = ['cantidadActualizada']; // Listeners para actualizar la cantidad de productos
    public $inputInvalid = false;

    public function mount()
    {
        $this->utilidad = config('settings.utility');
        // $this->priceScales = false;
        if ($this->currentQuote) {
            $this->product = Product::find($this->currentQuote->product_id);
            // Calculo de Precio
            $this->colores = $this->currentQuote->color_logos;
            $this->operacion = $this->currentQuote->costo_indirecto;
            $this->cantidad =  $this->currentQuote->cantidad ?: 1;
            $this->utilidad =  $this->currentQuote->utilidad;
            $this->entrega =  $this->currentQuote->dias_entrega;
            $this->newPriceTechnique =  $this->currentQuote->new_price_technique;
            $this->newDescription =  $this->currentQuote->new_description;
            $this->imageSelected =  $this->currentQuote->images_selected;

            $prices_techniques = PricesTechnique::find($this->currentQuote->prices_techniques_id);
            $this->materialSeleccionado = $prices_techniques->sizeMaterialTechnique->materialTechnique->material->id;
            $this->tecnicaSeleccionada = $prices_techniques->sizeMaterialTechnique->materialTechnique->technique->id;
            $this->sizeSeleccionado = $prices_techniques->sizeMaterialTechnique->size->id;
            //$this->priceScales = $this->currentQuote->quote_by_scales;
            /*     if ($this->priceScales) {
                $this->priceScalesComplete = json_decode($this->currentQuote->scales_info);
                $this->infoScales = array_map(function ($scale) {
                    return ['quantity' => $scale->quantity, 'utility' => $scale->utility, 'tecniquePrice' => $scale->tecniquePrice];
                }, $this->priceScalesComplete);
            } */
        }
        if ($this->productEdit) {
            $product = json_decode($this->productEdit['product']);
            $this->product = Product::find($product->id);
            $techniquesInfo =  (object) json_decode($this->productEdit['technique']);

            $this->materialSeleccionado = $techniquesInfo->material_id;
            $this->tecnicaSeleccionada = $techniquesInfo->tecnica_id;
            $this->sizeSeleccionado = $techniquesInfo->size_id;
            $this->currentQuote_id = $this->productEdit['id'];
            $this->imageSelected = $product->image;


            $this->colores = $this->productEdit['color_logos'];
            $this->operacion = $this->productEdit['costo_indirecto'];
            $this->cantidad = $this->productEdit['cantidad'] ?: 1;
            $this->utilidad = $this->productEdit['utilidad'];
            $this->entrega = $this->productEdit['dias_entrega'];
            $this->newPriceTechnique = $this->productEdit['prices_techniques'];
            $this->newDescription =  $this->productEdit['new_description'];
        }
        if ($this->productNewAdd) {
            $this->product = $this->productNewAdd;
        }

        $utilidad = (float) config('settings.utility');
        
        $priceProduct = $this->product->price;
        // Verifica si existe el atributo 'Outlet' y hace el 30 de descuento
        $productType = $this->product->productAttributes->where('attribute', 'Tipo Descuento')->first();
        if ($productType && $productType->value == 'Normal') {
            $priceProduct = round($priceProduct - $priceProduct * (30 / 100), 2);
        } else if ($productType && ($productType->value == 'Outlet' || $productType->value == 'Unico')) {
            $priceProduct = round($priceProduct - $priceProduct * (0 / 100), 2);
        } else {
            if ($this->product->producto_promocion) {
                $priceProduct = round($priceProduct - $priceProduct * ($this->product->descuento / 100), 2);
            } else {
                $priceProduct = round($priceProduct - $priceProduct *  ($this->product->provider->discount / 100), 2);
            }
            if ($this->product->provider->company == 'EuroCotton') {
                $iva = $priceProduct * 0.16;
                $priceProduct = round($priceProduct - $iva, 2);
            }
            if ($this->product->provider->company  == 'For Promotional') {
                if ($this->product->descuento >= $this->product->provider->discount) {
                    $priceProduct = round($this->product->price - $this->product->price * ($this->product->descuento / 100), 2);
                } else {
                    $priceProduct = round($this->product->price - $this->product->price * (25 / 100), 2);
                }
            }
        }

        $this->precio = $priceProduct;

        $this->precioCalculado = $this->precio;
    }

    // 
    public function cantidadActualizada($nuevaCantidad)
    {
        
        $this->cantidad = $nuevaCantidad;
        // Verificar si la cantidad es mayor al stock
        if ($this->cantidad > $this->product->stock) {
            $this->inputInvalid = true;
        } else {
            $this->inputInvalid = false;
        }
    }

    public function render()
    {
        $this->entrega = 15;

        $this->precioTotal = 0;


        // Obtener precios de las tecnicas

        // Obtengo Materiales
        $materiales = Material::all();

        // Obtengo las tenicas disponibles de acuerdo al material seleccionado
        $techniquesAvailables = [];
        if ($this->materialSeleccionado !== null && $this->materialSeleccionado !== "") {
            $techniques = Material::find((int)$this->materialSeleccionado);
            if ($techniques) {
                $techniquesAvailables = $techniques->materialTechniques;
            } else {
                $techniquesAvailables = [];
            }
        } else {
            $this->tecnicaSeleccionada = null;
            $techniquesAvailables = [];
        }
        $sizesAvailables = [];
        $materialTechnique = '';
        if ($this->tecnicaSeleccionada !== null && $this->tecnicaSeleccionada !== "") {
            $materialTechnique = MaterialTechnique::where('technique_id', (int)$this->tecnicaSeleccionada)->where('material_id', (int)$this->materialSeleccionado)->first();
            if ($materialTechnique) {
                $sizesAvailables = $materialTechnique->sizeMaterialTechniques;
            } else {
                $sizesAvailables = [];
            }
        } else {
            $sizesAvailables = [];
            $this->sizeSeleccionado = null;
        }

        $preciosDisponibles = [];
        if ($this->sizeSeleccionado !== null && $this->sizeSeleccionado !== "") {
            $preciosDisponibles = SizeMaterialTechnique::where('material_technique_id', $materialTechnique->id)->where('size_id', (int)$this->sizeSeleccionado)->first()->pricesTechniques;
        } else {
            $preciosDisponibles = [];
            $this->sizeSeleccionado = null;
        }

        // Calculo de Precio
        if (!is_numeric($this->colores))
            $this->colores = null;
        if (!is_numeric($this->operacion))
            $this->operacion = null;
        if (!is_numeric($this->utilidad))
            $this->utilidad = null;
        if ($this->utilidad > 99)
            $this->utilidad = 99;

        $precioDeTecnica = 0;

        if (!$this->priceScales) {
            if (!is_numeric($this->cantidad))
                $this->cantidad = null;

            if (!is_numeric($this->newPriceTechnique))
                $this->newPriceTechnique = null;

            if ((int)$this->cantidad > 0 && $preciosDisponibles && $this->sizeSeleccionado !== null) {
                foreach ($preciosDisponibles as $precioDisponible) {
                    if ($precioDisponible->escala_final != null) {
                        if ((int)$this->cantidad >= $precioDisponible->escala_inicial  &&  (int)$this->cantidad <= $precioDisponible->escala_final) {
                            $this->priceTechnique = $precioDisponible;
                            $precioDeTecnica = $precioDisponible->tipo_precio == "D" ? round($precioDisponible->precio / (int)$this->cantidad, 2) : $precioDisponible->precio;
                        }
                    } else if ($precioDisponible->escala_final == null) {
                        if ((int)$this->cantidad >= $precioDisponible->escala_inicial) {
                            $this->priceTechnique = $precioDisponible;
                            $precioDeTecnica = $precioDisponible->tipo_precio == "D" ? round($precioDisponible->precio / (int)$this->cantidad, 2) : $precioDisponible->precio;
                        }
                    }
                }
            } else {
                $precioDeTecnica = 0;
                $this->priceTechnique = null;
            }
           
            if($this->tipoEnvio == 'foraneo'){
                $precioDeTecnicaUsado = $precioDeTecnica;
                $piezasCaja = $this->product->productAttributes->firstWhere('slug', 'piezas_caja');

                $this->totalCajas = ceil(floatval( $this->cantidad == 0? 1 :$this->cantidad ) / floatval($piezasCaja->value));
                /* $this->totalCajas = ceil(floatval($this->cantidad) / floatval($piezasCaja->value)); */
        
                $this->precioProductoCajas = floatval($this->totalCajas * 400);
                

                $this->precioUnitarioEnvio = floatval($this->precioProductoCajas / (($this->cantidad == null || $this->cantidad == 0) ? 1 : $this->cantidad));

            }else{
                $precioDeTecnicaUsado = $precioDeTecnica + 0.6;
            }
            
            if ($this->newPriceTechnique != null && $this->newPriceTechnique >= 0)
                $precioDeTecnicaUsado = $this->newPriceTechnique;
            

            if($this->tipoEnvio == 'foraneo'){
                $this->costoCalculado = (($this->precio + $this->precioUnitarioEnvio + ($precioDeTecnicaUsado * $this->colores) ) / 0.8) ;

            }else{
                $this->costoCalculado = (($this->precio + ($precioDeTecnicaUsado * $this->colores) + 0.60 ) / 0.8) ;
            }

            $this->costoTotal = $this->costoCalculado * $this->cantidad;
            
        }

        $this->precioDeTecnica = $precioDeTecnica;
        return view('pages.catalogo.formulario-de-cotizacion', [
            'materiales' => $materiales,
            'techniquesAvailables' => $techniquesAvailables,
            'sizesAvailables' => $sizesAvailables,
            'preciosDisponibles' => $preciosDisponibles,
            "precioDeTecnica" => $precioDeTecnica
        ]);
    }


    public function agregarCarrito()
    {      
        $this->validate([
            'priceTechnique' => 'required',
            'cantidad' => 'required|numeric|min:1',
            'colores' => 'required|numeric|min:0',
        ]); 

        $user = Auth::user();
        $piezas = $this->product->productAttributes->firstWhere('slug', 'piezas_caja');
        $material = Material::findOrFail($this->materialSeleccionado);
        $technique = Technique::findOrFail($this->tecnicaSeleccionada);
        $size = Size::find($this->sizeSeleccionado);       
      
        $temporalImage = TemporalImageUrl::where('product_id', $this->product->id)->where('type', 'no used')->where('user_id', $user->id)->get()->last();

        $currentQuote = auth()->user()->currentQuote;

        $more_detail = [];

        array_push( $more_detail, (object)[
            'embalaje' => isset($this->embalaje)? 1:0,
            'armado'  => isset($this->armado)? 1:0,
            'destino' => isset($this->destino)? 1:0,
            'detalles' => $this->detalles != ""? $this->detalles : "",
            'envio'=> $this->tipoEnvio == null? 'local' : $this->tipoEnvio,
            'piezasCaja'=>  isset($piezas->value)? $piezas->value : 00,
            "precioDeTecnica" => $this->precioDeTecnica,
            "guias" => $this->totalCajas,
        ]);

        if ($currentQuote === null) {

            $currentQuote = auth()->user()->currentQuote()->create([
                'discount' => false
            ]);
        } else {
            if (auth()->user()->currentQuote) {
                auth()->user()->currentQuote->discount = false;
                auth()->user()->currentQuote->type =  null;
                auth()->user()->currentQuote->value = null;
                auth()->user()->currentQuote->save();
            }
        }
        $imageName = "";
        if (isset($temporalImage->src_image)) {
            $imageName = $temporalImage->src_image;
            $temporalImage->delete();
        }
        // Renombrar la imagen
        // Subir la imagen
        /* $this->photo->storeAs('public/logos', $imageName); */

        $creteUserlog = new UserLogs();
        $creteUserlog->user_id = $user->id;
        $creteUserlog->type = 'producto';
        $creteUserlog->value = 'agregar al carrito';
        $creteUserlog->save();

        $dataQuote = [
            'product_id' => $this->product->id,
            'color_logos' => $this->colores,
            'dias_entrega' => $this->entrega,
            'product_id' => $this->product->id,
            'price_technique' => $this->precioDeTecnica *  $this->colores,
            'color_logos' => $this->colores,
            'dias_entrega' => $this->entrega,
            'cantidad' => $this->cantidad,
            'precio_unitario' => $this->costoCalculado,
            'precio_total' => $this->costoTotal,
            'logo' => $imageName,
            'more_details' => json_encode($more_detail)
        ];

        $createCurrentQuote =  $currentQuote->currentQuoteDetails()->create($dataQuote);

        $createCurrentQuotesTechniques = new CurrentQuotesTechniques();
        $createCurrentQuotesTechniques->current_quotes_details_id = $createCurrentQuote->id;
        $createCurrentQuotesTechniques->material = $material->nombre;
        $createCurrentQuotesTechniques->technique = $technique->nombre; 
        $createCurrentQuotesTechniques->size = $size->nombre; 
        $createCurrentQuotesTechniques->save();

        session()->flash('message', 'Se ha agregado este producto al carrito.');
        $this->emit('currentQuoteAdded');
        $this->dispatchBrowserEvent('addProducto');
        $this->resetData();
    }

    public function editarCurrentCotizacion()
    {
        $this->validate([
            'colores' => 'required|numeric|min:1',
            'operacion' => 'required|numeric|min:0',
            'entrega' => 'required|numeric|min:0',
        ]);
        if (!$this->priceScales) {
            $this->validate([
                'priceTechnique' => 'required',
                'cantidad' => 'required|numeric|min:1',
                'utilidad' => 'required|numeric|min:0|max:99',
            ]);
            //$this->infoScales = [];
        } /* else {
            $this->validate([
                'priceTechnique' => 'required',
                'infoScales' => 'array|required',
                'infoScales.*.quantity' => 'required|numeric|min:1',
            ]);
            $this->cantidad = 0;
            $this->utilidad = 0;
        } */

        if (!is_numeric($this->newPriceTechnique))
            $this->newPriceTechnique = null;
        if (trim($this->newDescription) == "")
            $this->newDescription = null;

        $dataQuote = [
            'product_id' => $this->product->id,
            'prices_techniques_id' => $this->priceTechnique->id,
            'new_description' => $this->newDescription,
            'color_logos' => $this->colores,
            'costo_indirecto' => $this->operacion,
            'dias_entrega' => $this->entrega,
            'images_selected' => $this->imageSelected
        ];

        if (!$this->priceScales) {
            $dataQuote['utilidad'] = $this->utilidad;
            $dataQuote['new_price_technique'] = $this->newPriceTechnique;
            $dataQuote['cantidad'] = $this->cantidad;
            $dataQuote['precio_unitario'] = $this->precioCalculado;
            $dataQuote['precio_total'] = $this->precioTotal;
            $dataQuote['quote_by_scales'] = false;
            $dataQuote['scales_info'] = null;
        } /* else {
            $dataQuote['utilidad'] = null;
            $dataQuote['new_price_technique'] = null;
            $dataQuote['cantidad'] = null;
            $dataQuote['precio_unitario'] = null;
            $dataQuote['precio_total'] = null;
            $dataQuote['quote_by_scales'] = true;
            $dataQuote['scales_info'] = json_encode($this->priceScalesComplete);
        }
        */
        $this->currentQuote->update($dataQuote);
        $this->resetData();
        $this->dispatchBrowserEvent('closeModal', ['currentQuote' => $this->currentQuote->id]);
        $this->emit('updateProductCurrent');
    }

    public function editarCotizacion()
    {
        $this->validate([
            'colores' => 'required|numeric|min:1',
            'operacion' => 'required|numeric|min:0',
            'entrega' => 'required|numeric|min:0',
        ]);
        if (!$this->priceScales) {
            $this->validate([
                'priceTechnique' => 'required',
                'cantidad' => 'required|numeric|min:1',
                'utilidad' => 'required|numeric|min:0|max:99',
            ]);
            //$this->infoScales = [];
        } /* else {
            $this->validate([
                'priceTechnique' => 'required',
                'infoScales' => 'array|required',
                'infoScales.*.quantity' => 'required|numeric|min:1',
            ]);
            $this->cantidad = 0;
            $this->utilidad = 0;
        } */
        $product = $this->product->toArray();
        $product['image'] = $this->imageSelected ?: ($this->product->firstImage ? $this->product->firstImage->image_url : '');
        unset($this->product->firstImage);
        unset($this->product->images);
        if (!is_numeric($this->newPriceTechnique))
            $this->newPriceTechnique = null;
        if (trim($this->newDescription) == "")
            $this->newDescription = null;

        $newQuote = [
            'currentQuote_id' => $this->currentQuote_id,
            'product' => json_encode($product),
            'prices_techniques_id' => $this->priceTechnique->id,
            'new_description' => $this->newDescription,
            'color_logos' => $this->colores,
            'costo_indirecto' => $this->operacion,
            'dias_entrega' => $this->entrega,
        ];

        if (!$this->priceScales) {
            $newQuote['utilidad'] = $this->utilidad;
            $newQuote['newPriceTechnique'] = $this->newPriceTechnique;
            $newQuote['cantidad'] = $this->cantidad;
            $newQuote['precio_unitario'] = $this->precioCalculado;
            $newQuote['precio_total'] = $this->precioTotal;
            $newQuote['quote_by_scales'] = false;
            $newQuote['scales_info'] = null;
        } /* else {
            $newQuote['utilidad'] = null;
            $newQuote['newPriceTechnique'] = null;
            $newQuote['cantidad'] = null;
            $newQuote['precio_unitario'] = null;
            $newQuote['precio_total'] = null;
            $newQuote['quote_by_scales'] = true;
            $newQuote['scales_info'] = json_encode($this->priceScalesComplete);
        } */

        $this->emit('productUpdate', $newQuote);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetData();
    }

    public function addNewProductToQuote()
    {
        $this->validate([
            'colores' => 'required|numeric|min:1',
            'operacion' => 'required|numeric|min:0',
            'entrega' => 'required|numeric|min:0',
        ]);
        if (!$this->priceScales) {
            $this->validate([
                'priceTechnique' => 'required',
                'cantidad' => 'required|numeric|min:1',
                'utilidad' => 'required|numeric|min:0|max:99',
            ]);
            //$this->infoScales = [];
        } /* else {
            $this->validate([
                'priceTechnique' => 'required',
                'infoScales' => 'array|required',
                'infoScales.*.quantity' => 'required|numeric|min:1',
            ]);
            $this->cantidad = 0;
            $this->utilidad = 0;
        } */

        $product = $this->product->toArray();
        $product['image'] = $this->imageSelected ?: ($this->product->firstImage ? $this->product->firstImage->image_url : '');
        unset($this->product->firstImage);
        unset($this->product->images);
        if (!is_numeric($this->newPriceTechnique))
            $this->newPriceTechnique = null;
        if (trim($this->newDescription) == "")
            $this->newDescription = null;
        $newQuote = [
            'idNewQuote' => time(),
            'product' => json_encode($product),
            'prices_techniques_id' => $this->priceTechnique->id,
            'new_description' => $this->newDescription,
            'color_logos' => $this->colores,
            'costo_indirecto' => $this->operacion,
            'dias_entrega' => $this->entrega,
        ];

        if (!$this->priceScales) {
            $newQuote['utilidad'] = $this->utilidad;
            $newQuote['newPriceTechnique'] = $this->newPriceTechnique;
            $newQuote['cantidad'] = $this->cantidad;
            $newQuote['precio_unitario'] = $this->precioCalculado;
            $newQuote['precio_total'] = $this->precioTotal;
            $newQuote['quote_by_scales'] = false;
            $newQuote['scales_info'] = null;
        } /* else {
            $newQuote['utilidad'] = null;
            $newQuote['newPriceTechnique'] = null;
            $newQuote['cantidad'] = null;
            $newQuote['precio_unitario'] = null;
            $newQuote['precio_total'] = null;
            $newQuote['quote_by_scales'] = true;
            $newQuote['scales_info'] = json_encode($this->priceScalesComplete);
        } */

        $this->emit('productAdded', $newQuote);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetData();
    }

    public function seleccionarImagen($image)
    {
        $this->imageSelected = $image;
        $this->dispatchBrowserEvent('hideModalImage');
    }

    public function eliminarImagen()
    {
        $this->imageSelected = null;
    }


    public function openModalImage()
    {
        $this->dispatchBrowserEvent('showModalImage');
    }
    public function closeModalImage()
    {
        $this->dispatchBrowserEvent('hideModalImage');
    }
    public function closeModal()
    {
        $this->dispatchBrowserEvent('hideModalImage');
    }

    public function resetData()
    {
        $this->priceTechnique = null;
        $this->colores = 0;
        $this->operacion = 0;
        $this->utilidad = 0;
        $this->entrega = 0;
        $this->cantidad = 0;
        $this->precioCalculado = 0;
        $this->precioTotal = 0;
        $this->newPriceTechnique = 0;
        $this->newDescription = '';
        /*       $this->infoScales = [];
        $this->priceScales = false; */
    }

    public function resetTecnique()
    {
        $this->sizeSeleccionado = null;
        $this->tecnicaSeleccionada = null;
    }
    public function resetSizes()
    {
        $this->sizeSeleccionado = null;
    }
}
