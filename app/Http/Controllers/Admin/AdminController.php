<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use View;
use App\Repositories\UserRepositoryInterface as UserRepository;

class AdminController extends Controller
{
	protected $user;

	public function __construct(UserRepository $user) {
		$this->user = $user;
	}

	public function index() {
		return view('admin.users');
	}

	public function getAllUsers() {
		$allUsers = $this->user->selectAll();
		return $allUsers;
		// return view('admin.users');
		// abort(401, 'This action is not authorized.');
	}
}
