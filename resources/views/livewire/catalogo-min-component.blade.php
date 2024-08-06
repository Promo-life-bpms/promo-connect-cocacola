<div>
    <div class="{{ trim($producto) == '' ? '' : 'd-none' }}">
        <div class="row">
            <div class="col-md-12">
                <input wire:model='nombre' type="text" class="form-control" name="search" id="search"
                    placeholder="Buscar Unicamente Por Nombre">
                <br>
            </div>
        </div>
        <div class="row">
            @php
                $counter = $products->perPage() * $products->currentPage() - $products->perPage() + 1;
            @endphp
            @if (count($products) <= 0)
                <div class="d-flex flex-wrap justify-content-center align-items-center flex-column">
                    <p>No hay resultados de busqueda en la pagina actual</p>
                    @if (count($products->items()) == 0 && $products->currentPage() > 1)
                        <p>Click en la paginacion para ver mas resultados</p>
                    @endif
                </div>
            @endif
            @foreach ($products as $product)
                <div class="col-md-4 col-lg-3 col-sm-6  d-flex justify-content-center">
                    <div class="card product-info">
                        <div class="card-body text-center shadow-sm p-2">
                            @php
                                $product_type = $product->productAttributes->where('attribute', 'Tipo Descuento')->first();

                                $priceProduct = $product->price;

                                if ($product_type && $product_type->value == 'Normal') {
                                    $precioTotal = round($priceProduct - $priceProduct * (30 / 100), 2);
                                    $priceProduct = $precioTotal / config('settings.utility');
                                    
                                } elseif (
                                    $product_type &&
                                    ($product_type->value == 'Outlet' || $product_type->value == 'Unico')
                                ) {
                                    $precioTotal = round($priceProduct - $priceProduct * (0 / 100), 2);
                                    $priceProduct = $precioTotal /config('settings.utility')/100);
                                } else {
                                    if ($product->producto_promocion) {
                                        $precioTotal = round($priceProduct - $priceProduct * ($product->descuento / 100),2,);
                                        $priceProduct = $precioTotal / config('settings.utility')/100);
                                    } else {
                                        $priceProduct = round($priceProduct - $priceProduct * ($product->provider->discount / 100),2,);

                                        $precioTotal = round($priceProduct - $priceProduct * ($product->provider->discount / 100),2,);
                                        $priceProduct = $precioTotal + ($precioTotal *(config('settings.utility')/100));
                                    }
                                    if ($product->provider->company == 'EuroCotton') {
                                        $precioTotal = round($priceProduct - $priceProduct * ($product->provider->discount / 100),2,);
                                        $iva = $precioTotal * 0.16;
                                        $precioTotal = round($priceProduct - $iva, 2);

                                        $priceProduct = $precioTotal /(config('settings.utility'));
                                    }

                                    if ($product->provider->company == 'For Promotional') {
                                        if ($product->descuento >= $product->provider->discount) {
                                            $precioTotal = round($product->price - $product->price * ($product->descuento / 100),2,);
                                            $priceProduct = $precioTotal + ($precioTotal *(config('settings.utility')/100));
                                        } else {
                                            $precioTotal = round($product->price - $product->price * (25 / 100), 2);
                                            $priceProduct = $precioTotal / (config('settings.utility'));
                                        }
                                    }
                                }
                            @endphp
                            <p class="stock-relative m-0 mb-1 pt-1" style="font-size: 16px">Stock: <span
                                    style="font-weight: bold">{{ $product->stock }}</span></p>
                            <div class="d-flex flex-row flex-sm-column">
                                <div class="text-center" style="height: 110px">
                                    <img src="{{ $product->firstImage ? $product->firstImage->image_url : '' }}"
                                        class="card-img-top " alt="{{ $product->name }}"
                                        style="width: auto; max-width: 100px; max-height: 110px; height: auto">
                                </div>
                                <div class="info-products">
                                    <h5 class="card-title m-0" style="text-transform: capitalize">
                                        {{ Str::limit($product->name, 22, '...') }}</h5>
                                    <p class=" m-0 pt-1" style="font-size: 16px"><strong>SKU:</strong>
                                        {{ $product->sku }}</p>
                                    <p class="m-0 mb-1 pt-1 d-sm-none" style="font-size: 16px">Stock: <span
                                            style="font-weight: bold">{{ $product->stock }}</span></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class=" m-0 pt-1" style="font-weight: bold">$
                                            {{ round($priceProduct / ((100 - $utilidad) / 100), 2) }}</p>
                                        <button class="btn btn-primary btn-sm"
                                            wire:click="seleccionarProducto({{ $product }})"> Seleccionar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex d-sm-none justify-content-center">
                {{ $products->onEachSide(0)->links() }}
            </div>
            <div class="d-none d-sm-flex justify-content-center">
                {{ $products->onEachSide(3)->links() }}
            </div>
        </div>
    </div>
    <div class="{{ trim($producto) == '' ? 'd-none' : '' }}">
        <div style="width: 20px; cursor: pointer;">
            <div wire:click="regresar()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
        </div>
        <br>
        @if (!trim($producto) == '')
            @php
                $priceProduct = $producto->price;
                if ($producto->producto_promocion) {
                    $priceProduct = round($priceProduct - $priceProduct * ($producto->descuento / 100), 2);
                } else {
                    $priceProduct = round($priceProduct - $priceProduct * ($producto->provider->discount / 100), 2);
                }
            @endphp
            <div class="d-flex">
                <div class="img-container w-25 text-center">
                    <img id="imgBox" style="max-width: 150px; max-height: 200px"
                        src="{{ $producto->firstImage ? $producto->firstImage->image_url : asset('img/default.jpg') }}"
                        class="img-fluid" alt="imagen">
                </div>
                <div class="px-3 flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">{{ $producto->name }}</h4>
                        </div>
                        @if ($producto->precio_unico)
                            <div class="w-25">
                                <h5 class="text-primary text-right">
                                    $ {{ round($priceProduct / ((100 - $utilidad) / 100), 2)  }}</p>
                                </h5>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="my-1"><strong>SKU Interno: </strong> {{ $producto->internal_sku }}</p>
                            <p class="my-1"><strong>SKU Proveedor: </strong> {{ $producto->sku }}</p>
                        </div>
                        <div>
                            <h5 class="text-success">Disponibles:<strong> {{ $producto->stock }}</strong> </h5>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            @livewire('formulario-de-cotizacion', ['productNewAdd' => $producto])
        @endif
    </div>
    <style>
        .product-info {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .info-products {
            flex-grow: 1;
            text-align: left;
        }

        @media(min-width:576px) {
            .product-info {
                width: 14rem;
                margin-bottom: 1.5rem;
            }

            .info-products {
                flex-grow: 0;
                text-align: center;
            }

            .stock-relative {
                display: block !important;
            }
        }

        .stock-relative {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #fcfcfcf2;
            border-radius: 5px;
            padding: 0px 5px;
            display: none;
        }
    </style>
</div>
