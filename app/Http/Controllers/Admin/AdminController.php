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
		var_dump('dasdsada');
		exit;
		return view('admin.users');
		
	}

	public function list() {
		return view('admin.users');
		
	}
}
