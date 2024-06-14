@component('mail::message')

# Confirmación de compra 

---

[Promo Life S. de R.L. de C.V.](https://www.promolife.mx/)
San Andrés Atoto 155A Naucalpan de Juárez, Méx. C.P. 53550  
Tel. +52(55) 63236061

Fecha: **{{ $date }}**

---

    @php

        $quoteTechnique = \App\Models\QuoteTechniques::where('quotes_id',$quotes->id)->get()->last();

        $product = \App\Models\QuoteProducts::where('id', $quotes->id)->get()->last();
        $productData = json_decode($product->product);

        $productName = isset($productData->name) ? $productData->name : 'Nombre no disponible';
        
        $quoteInformation = \App\Models\QuoteInformation::where('id',$quotes->id)->get()->first();

    @endphp

#Compra: **{{ isset($quoteInformation->information)? $quoteInformation->information: '' }}**

## Descripción
{{ $productName }}

### Técnica de Personalización
| Descripción                      | {{ isset($quotes->currentQuotesTechniques->technique) ? $quotes->currentQuotesTechniques->technique : '' }} |
|----------------------------------|-------------------------------------------------------------------------------------------------------------------|
| Material                         | {{ isset($quoteTechnique->material) ? $quoteTechnique->material : '' }}                                           |
| Tamaño                           | {{ isset($quoteTechnique->size) ? $quoteTechnique->size : '' }}                                                   |

**Tiempo de Entrega:** 10 días hábiles

### Detalles del Producto
| Cantidad         | Precio Unitario  | Precio total      |
|------------------|------------------|-------------------|
| {{ $product->cantidad }} piezas | {{ $product->precio_unitario }} | {{ $product->precio_total }} |

---

---

Condiciones:
- Condiciones de pago acordadas en el contrato
- Precios unitarios mostrados antes de IVA
- Precios mostrados en pesos mexicanos (MXP)
- Condiciones de pago acordadas con el vendedor
- Precios unitarios mostrados antes de IVA
- Precios mostrados en pesos mexicanos (MXP)
- El importe cotizado corresponde a la cantidad de piezas y número de tintas arriba mencionadas, si se modifica el número de piezas el precio cambiaría.
- El tiempo de entrega empieza a correr una vez recibida la Orden de Compra y autorizada la muestra física o virtual a solicitud del cliente.
- Vigencia de la cotización 10 días hábiles.
- Producto cotizado de fabricación nacional o importación puede afinarse la fecha de entrega previo a la emisión de Orden de Compra.
- Producto cotizado disponible en stock a la fecha de esta cotización puede modificarse al paso de los días sin previo aviso. Solo se bloquea el inventario al recibir Orden de Compra
@endcomponent