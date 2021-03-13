<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index(){
        $admins = User::where('role', 'Admin')->get();
        $members = User::where('role', 'Customer')->get();
        $transactions = Transaction::all();
        $products = Product::all();
        return view('dashboard',['admins'=>$admins,'members'=>$members,'transactions'=>$transactions,'products'=>$products]);
    }
}
