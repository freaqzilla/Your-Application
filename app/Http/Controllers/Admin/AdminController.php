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
		$allUsers = $this->user->selectAll();
		return $allUsers;
		// return view('admin.users');
		// abort(401, 'This action is not authorized.');
	}

	public function getUser($userId) {
		ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ini_set('memory_limit','512M');
// $memory_limit = ini_get('memory_limit');
// var_dump($memory_limit);
// exit;
		try {
			$userId = intval(15);
			$user = $this->user->find($userId)->load('roles');
		// $user = $this->user->with('roles')->where('id', $userId)->first();
		var_dump($user);
exit;
			// do your database transaction here
		} catch (\Illuminate\Database\Exception $e) {
			// var_dump($e);
			// exit;
		} catch (\Exception $e) {
			var_dump($e);
			exit;
			// something went wrong elsewhere, handle gracefully
		}
	}
}
