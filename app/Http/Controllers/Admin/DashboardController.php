<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class DashboardController extends Controller
{
       
	public function dashboard()
	{
		$user = auth()->user();
		if($user->role_id=='1'){
			return view('backend.index');
		}else{
			    Auth::logout();
			return view('welcome');
		}
		
	}






}
