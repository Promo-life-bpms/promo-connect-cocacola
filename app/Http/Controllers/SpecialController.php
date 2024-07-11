<?php

namespace App\Http\Controllers;

use App\Models\Catalogo\Image;
use App\Models\Catalogo\Product;
use App\Models\Catalogo\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialController extends Controller
{
    public function especialCambiarStatus(Request $request) {
        $request->validate([
            'status' => 'required'
        ]);

        DB::table('special_request')->where('id', $request->id)->update([
            'status' => $request->status == 'process' ? 2: 3
        ]);

        return back()->with('success', 'Solicitud actualizada correctamente');

    }

    public function especialAltaProducto(Request $request) {

        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0'
        ]);   

        $search_provider = Provider::where('company','PORTALHHGLOBAL')->get()->first();

        $provider_id = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension(); 
            $fileNameToStore = time() . '_' . $filename . '.' . $extension;
        
            $pathFile = $file->storeAs('public/art/files', $fileNameToStore);    
        } else {
            return back()->with('error', 'No se encontró el archivo');
        }


        if($search_provider == null || $search_provider == []){

            $create_provider = new Provider();
            $create_provider->company = 'PORTALHHGLOBAL';
            $create_provider->email = 'no-mail';
            $create_provider->phone = '55555';
            $create_provider->contact = 'false';
            $create_provider->discount = 0;
            $create_provider->save();

            $provider_id =  $create_provider->id;
        }else{
            $provider_id =  $search_provider->id;
        }

        $create_product = new Product();
        $create_product->internal_sku = 'HHGLOBAL-0' . uniqid();
        $create_product->sku_parent = null;
        $create_product->sku = 0;
        $create_product->name = $request->name;
        $create_product->description = $request->description;
        $create_product->price = $request->price;
        $create_product->stock = $request->stock;
        $create_product->producto_promocion = 0;
        $create_product->descuento = 0;
        $create_product->producto_nuevo = 0;
        $create_product->precio_unico = 1;
        $create_product->disponible = 1;
        $create_product->type_id = 3;
        $create_product->color_id = null;
        $create_product->provider_id = $provider_id;
        $create_product->visible = 1;
        $create_product->save();
        
        $create_product_image = new Image();
        $create_product_image->image_url = $pathFile;
        $create_product_image->product_id = $create_product->id;
        $create_product_image->save();

        return back()->with('success', 'Producto dado de alta satisfactoriametne, ahora puedes visualizarlo en el catálogo de productos');


    }
}
