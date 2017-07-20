<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function getAccount(){
    	 return view('admin.pages.user.user-management.user-management');
    }
}
