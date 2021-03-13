<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Transaction;
use Auth;

class StoreController extends Controller
{
    public function index(){
        $products = Product::where('stock', '>', 0)->get();
        return view('main.index', ['products'=>$products]);
    }
    public function showDetail(Product $product){
        return view('main.product-detail', ['product'=>$product]);
    }
    public function cartStore(Product $product, Request $request){
        $cart = Cart::where('product_id', $product->id)->where('user_id', Auth::id())->first();
        if (empty($cart)) {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'total' => $product->price * $request->qty
            ]);
        }
        else{
            $cart->qty = $cart->qty + $request->qty;
            $cart->total = $cart->total + ($product->price * $request->qty);
            $cart->save();
        }
        return redirect()->route('main.detail', $product)->with(['successinsertcart'=>'Sukses dimasukan ke keranjang']);
    }
    public function cartDetail($id){
        $carts = Cart::where('user_id', $id)->get();
        $total = $carts->sum('total');
        return view('main.cart-detail', ['carts'=>$carts,'total'=>$total]);
    }
    public function cartUpdate(Request $request){
        $this->validate($request,[
            'qty' => 'numeric|required|min:1'
        ]);
        $cart = Cart::find($request->id);
        $cart->qty = $request->qty;
        $cart->total = $cart->product->price * $request->qty;
        $cart->save();
        return redirect()->route('main.cart', Auth::user()->id)->with(['successeditcart'=>'Sukses edit keranjang']);
    }
    public function cartDestroy(Cart $cart){
        $cart->delete();
        return redirect()->route('main.cart', Auth::user()->id)->with(['successdeletecart'=>'Sukses delete item']);
    }
    public function search(Request $request){
        $products = Product::where('name', 'like', '%'.$request->keyword.'%')->get();
        return view('main.index', ['products'=>$products]);
    }
    public function pembelianIndex(){
        $transactions = Transaction::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();
        return view('main.pembelian', ['transactions'=>$transactions]);
    }
}
