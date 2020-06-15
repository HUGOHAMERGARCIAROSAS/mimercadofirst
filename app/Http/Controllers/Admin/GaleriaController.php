<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\src\Models\Product;
use App\src\Models\Galery;
use DB;

class GaleriaController extends Controller
{
    public function index($id){
        $producto = Product::findOrFail($id);
        $galeria = Galery::where('producto_id',$id)->get();
        return view('admin.pages.providers.galeria')->with(compact('producto','galeria'));
    }

    public function store(Request $request , $id){
        DB::transaction(function () use ($request , $id) { 
            
            $imgs = $request->file('file');
            
            if($imgs){
                for ($i = 0; $i < count($imgs); $i++) {
                    $img = $imgs[$i];
                    $name = 'slider_'.time().$i.'.'.$img->getClientOriginalExtension();
                    $path = public_path().'/galeria_productos/';
                    $img->move($path, $name);

                    $galeria = new Galery();
                    $galeria->img = $name;
                    $galeria->producto_id = $id;
                    $galeria->save();
                }
            }                        
        });
        return redirect()->route('productos.galeria',$id);
    }

    public function delete($id)
    {
         DB::transaction(function () use ($id) { 
            $galeria = Galery::findOrFail($id);            
            unlink(public_path().'/galeria_productos/'.$galeria->img);

            $galeria->delete();
        });                

        return redirect()->back();
    }
}
