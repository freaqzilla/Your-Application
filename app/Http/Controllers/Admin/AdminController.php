<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;

class AdminController extends Controller
{
	public function index() {
		if (View::exists('admin.users')) {
			return view('admin.users');
		} else {
			var_dump('no view');
			exit;
		}
		
	}
}
