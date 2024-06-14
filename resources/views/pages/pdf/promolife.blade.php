<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cotizacion</title>
    <link rel="stylesheet" href="quotesheet/bh/stylebh.css">
    <link rel="stylesheet" href="quotesheet/pz/style.css">

</head>

<body>
  
    <header>
        <img src="img/header.png" alt="logo" style="width: 100%; z-index:1; position:absolute;">
        <p style="margin-left:652px; margin-top:72px; z-index:2; color:#FFFFFF; font-size:12px;"><b>QS</b></p>

        <p style="margin-left:672px; margin-top:2px; z-index:2; color:#FFFFFF; font-size:12px;"><b>{{$date}}</b></p>
            <div style="z-index:4; margin-top:20px;">
            <img src="img/hhglobal_negro.png" alt="loreal" style="width: 70px; z-index:4; margin-top:30px; margin-left:72px; margin-bottom: 2px;">
            <center>
               
                <span style="display: inline; margin-right:30px; color:#0225F4;"><b>Vendedor: </b> <b style="color:black;">Daniel Levy Hano </b> </span>
                <span style="display: inline; margin-right:30px;"> <img src="img/whatsapp.png" alt="whatsapp" style="width: 14px; margin-right:10px;"><b>5530395106</b> </span>
                <span style="display: inline; margin-right:30px;"> <img src="img/email.png" alt="whatsapp" style="width: 14px; margin-right:10px;"><b>daniel@trademarket.com.mx </b></span>
            </center>
        </div> 
       
    </header>

    <footer style="margin-top: -40px;">
        <table class="footer content">
            <tr>
                <td colspan="3">
                    <center  style="font-size: 20px; margin-bottom:5px; padding-right:230px; padding-left:230px;">

                        <div style=" background-color:#03FB99; border-radius: 10px; ">
                            <img src="img/world.png" alt="" style="width:15px; heigth:15px;">
                            <b>
                                <a style="text-decoration: none; color:black; font-size:18px;" href="https://trademarket.com.mx/">TRADEMARKET.COM.MX</a>
                            </b>
                        </div>
                        
                    </center>
                
                <center style="font-size:12px; margin-top:10px;"><b>San Andrés Atoto 155A Naucalpan de Juárez, Mex. C.P. 53550 Tel: (55) 5290 9100</b> </center>
            </td>
            </tr>
            
        </table>
        <div style="text-align: right; margin-top:-20px;">
            <p class="content">Pagina <span class="pagenum"></span></p>
        </div>
    </footer> 

    <div style="margin-left:30px; margin-right:30px; margin-top:8px; z-index:10;">
        
        <div style="width: 100%; height:1px; background-color:black; margin-top:8px; "></div>
        
        @foreach($quotes as $quote)
            
            @php
                
                $quoteTechnique = optional(\App\Models\QuoteTechniques::where('quotes_id', $quote->id)->latest()->first());

                $product = optional(\App\Models\QuoteProducts::where('id', $quote->id)->latest()->first());

                $productData = json_decode($product->product);

                $productImage = \App\Models\Catalogo\Image::where('product_id', $productData->id)->get()->first();

                $productName = optional($productData)->name ?? 'Nombre no disponible';

                $productLogo = optional($productData)->logo;

/*                 $category = $product->categories[0]->id;
 */
                $productBD =  optional(\App\Models\Catalogo\Product::where('id', $productData->id)->latest()->first());

                $category =  $productBD->categories[0]->id ? $productBD->categories[0]->id:0;

                if($productLogo != '' || $productLogo !=null){
                    $filePath = public_path('/storage/logos/' . $productLogo);
                }else{
                    $logo = $productImage->image_url;

                    $filename = basename($logo);

                    $encodedFilename = rawurlencode($filename);

                    $encodedUrl = str_replace($filename, $encodedFilename, $logo);

                    $ch = curl_init($encodedUrl);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $imageData = curl_exec($ch);

                    curl_close($ch);

                    $image64 = base64_encode($imageData);
                }

            @endphp
            
                <br>
                <p style="margin-left:60px;">Cotizacion: <b>SQ-{{ $quote->id }}</b></p>
                <table border="1" >
                    <tr>
                        <th style="width:30%" >Imagen de Referencia</th>
                        <th style="width:70%" colspan="3">Descripción 
                    </th>
                    </tr>
                    <tr>
                        <td rowspan="6" style="width:30%"> 

                        @if($productLogo != null || $productLogo != '')
                            <center><img style="width:200px; height:240px; object-fit:contain;" src="{{$filePath}}" alt=""></center>
                        @else
                            <center><img style="width:200px; height:240px; object-fit:contain;" src="data:image/png;base64,{{$image64}}" alt=""></center>
                        @endif
                        </td>
                        <td colspan="3" style="width:70%; padding:2px;">
                            {{ $productName }}

                            @switch($category)
                                @case(0)
                                    <p> <b>Categoría:</b>  Otra</p>

                                    @break
                                @case(27)
                                    <p> <b>Categoría:</b>  PPD Salon Tools / Professional Beauty & Make-up Tools / Promotional jewelry & small metal accessories </p>
                                    
                                    @break
                                @case(47)
                                    <p> <b>Categoría:</b> Luggage & Trolley (no brand) / Standard Bags and Pouches </p>

                                    @break
                                @case(22)
                                    <p> <b>Categoría:</b> Standard/Customized electric devices (no brand)  </p>

                                    @break
                                @case(8)
                                    <p> <b>Categoría:</b> Scarfs & sarongs </p>

                                    @break
                                @case(9)
                                    <p> <b>Categoría:</b>  Standard gifts & accessories & stationary (from stock items)</p>

                                    @break
                                @case(4)
                                    <p> <b>Categoría:</b>  Promotional Towel Items & Bath Robes / Scarfs & sarongs</p>

                                    @break
                                @case(44)
                                    <p> <b>Categoría:</b>  Tee-Shirt</p>

                                    @break
                                @case(5)
                                    <p> <b>Categoría:</b>  Others promotional textiles </p>

                                    @break
                                    
                                @default
                                    
                            @endswitch
                        </td>
                        
                    </tr>
                    <tr>
                        <th colspan="1" style="width:35%; padding:2px;">Tecnica de Personalizacion </th>
                        <th colspan="2" style="width:35%; padding:2px;" >Detalle de la Personalizacion </th>
                    </tr>
                    <tr>
                        <td colspan="1" style="width:35%">{{ isset($quoteTechnique->technique)? $quoteTechnique->technique :  '' }} </td>
                        <td colspan="2" style="width:35%">
                            <p> <b>Material: </b>  {{ isset($quoteTechnique->material)? $quoteTechnique->material : ''  }} </p>
                            <p> <b>Tamaño: </b>  {{ isset($quoteTechnique->size)? $quoteTechnique->size : '' }} </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="width:10% ;"><center><b>Tiempo de Entrega: 10 días hábiles</b> </center>  </td>
                    </tr>
                    <tr>
                        <th colspan="1">Cantidad</th>
                        <th colspan="1">Precio Unitario</th>
                        <th colspan="1">Precio total</th>
                    </tr>
                    <tr>
                        <td colspan="1"> {{ $product->cantidad}} piezas</td>
                        <td colspan="1"> $ {{ number_format($product->precio_unitario , 2, '.', ',') }} mxn </td>
                        <td colspan="1"> $ {{ number_format($product->precio_total , 2, '.', ',') }} mxn </td>
                    </tr>
                </table>
            <br>
        @endforeach
           
    </div>

    <div style="margin-left:30px;">
        <p> Condiciones:</p>
        <ul>
            <li>Condiciones de pago acordadas en el contrato</li>
            <li>Precios unitarios mostrados antes de IVA</li>
            <li>Precios mostrados en pesos mexicanos (MXN)</li>
            <li>Una vez entregada la orden de compra y/o muestra física aprobada, la entrega de los productos se realizará en un plazo estimado de 10 días hábiles.</li>
            <li>Antes de generar la orden de compra, le invitamos a verificar la disponibilidad actual de stock para garantizar la prontitud en el cumplimiento de su pedido.</li>
        </ul>
    </div>

</body>

</html>