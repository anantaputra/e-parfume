<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        $customers = array();

        foreach($users as $user) {
            if($user->roles[0]->name != 'admin') {
                $customers[] = $user;
            }
        }

        return view('admin.pages.customer', compact('customers'));
    }
}
