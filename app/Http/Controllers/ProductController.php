<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.index', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:50',
            'detail' => 'required',
            'stock' => 'required|numeric|min:0',
            'price' => 'required|numeric'
        ]);
        $file = $request->file;
        $fileName = time()."_".$file->getClientOriginalName();
        $path = 'gambar_produk';
        $file->move($path, $fileName);
        $product = Product::create([
            'img' => $fileName,
            'name' => $request->name,
            'detail' => $request->detail,
            'stock' => $request->stock,
            'price' => $request->price
        ]);
        return redirect()->route('products.index')->with(['successinsert'=>'Tambah Produk Sukses']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = 0)
    {
        $this->validate($request,[
            'file' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:50',
            'detail' => 'required',
            'stock' => 'required|numeric|min:0',
            'price' => 'required|numeric'
        ]);
        $product = Product::find($request->id);
        if (!empty($request->file)) {
            $file = $request->file;
            $fileName = time()."_".$file->getClientOriginalName();
            $path = 'gambar_produk';
            File::delete('gambar_produk/'.$product->img);
            $file->move($path, $fileName);
            $product->img = $fileName;
        }
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('products.index')->with(['successedit'=> 'Edit produk sukses']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        File::delete('gambar_produk/'.$product->img);
        $product->delete();
        return redirect()->route('products.index')->with(['successdelete'=> 'Delete produk sukses']);
    }
}
