<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::orderBy('created_at', 'DESC')->get();
        return view('transactions.index', ['transactions'=>$transactions]);
    }
    public function store(){
        $id = auth()->id();
        $carts = Cart::where('user_id', $id)->get();
        $arrItems = [];
        foreach ($carts as $item) {
            if($item->qty > $item->product->stock){
                array_push($arrItems, $item->product->name);
            }
        }
        if(empty($arrItems)){
            $total = $carts->sum('total');
            $str1 = "INV".date('ymd');
            $findStr2 = Transaction::where('invoice', 'like', '%' . $str1 . '%')->orderBy('created_at', 'desc')->first();
            if($findStr2 === null){
                $str1 = $str1."0001";
            }
            else{
                $findStr3 = $findStr2->invoice;
                $strNum = substr($findStr3, 9, 13);
                $strNum = $strNum+1;
                $str1 = $str1."".sprintf('%04s', $strNum);
            }
            /* max payment = current date + 3 days */
            $max_date = date('Y-m-d', strtotime('+3 days', strtotime(now())));
            $transaction = Transaction::create([
                'user_id' => $id,
                'total' => $total,
                'invoice' => $str1,
                'status' => 'Unpaid',
                'max_payment' => $max_date
            ]);
            foreach ($carts as $cart) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_name' => $cart->product->name,
                    'qty' => $cart->qty,
                    'price' => $cart->product->price
                ]);
                $cart->product->stock = $cart->product->stock - $cart->qty;
                $cart->product->save();
                $cart->delete();
            }
            return redirect()->route('main.cart', auth()->id())->with(['successprocesscart'=>'Item sudah di proses']);
        }
        else{
            $itemName = '';
            foreach ($arrItems as $arrItem) {
                if (end($arrItems) == $arrItem) {
                    $itemName = $itemName.' '.$arrItem;
                }
                else{
                    $itemName = $itemName.' '.$arrItem.',';
                }
            }
            return redirect()->route('main.cart', auth()->id())->with(['errorprocess'=>'Max. pembelian untuk '.$itemName.' melebihi stok, silahkan cek qty pembelian anda!']);
        }
        
    }
    public function destroy(Transaction $transaction){
        $transaction->delete();
        return redirect()->route('transactions.index')->with(['successdeletetransaction'=>'Permintaan transaksi sudah di hapus']);
    }
}
