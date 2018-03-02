<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use View;
use App\Repositories\UserRepository as UserRepository;

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
		$allUsers = $this->user->all();
		return $allUsers;
		// return view('admin.users');
		// abort(401, 'This action is not authorized.');
	}

	public function showUser($userId) {
		$user = $this->user->find($userId)->load('roles');
		return view('admin.editUser');
	}

	public function getUser($userId) {
		$user = $this->user->find($userId)->load('roles');
		return $user;
	}

	public function editUser(Request $request) {
		var_dump('reached');
		exit;
		// $user = $this->user->find($userId)->load('roles');
		// return $user;
	}
}
