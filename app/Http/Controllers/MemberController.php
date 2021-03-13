<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberController extends Controller
{
    public function index(){
        $members = User::where('role', 'Customer')->get();
        return view('members.index', ['members'=>$members]);
    }
    public function destroy(User $member){
        $member->delete();
        return redirect()->route('members.index')->with(['successdelete'=>'Delete member sukses']);
    }
}
