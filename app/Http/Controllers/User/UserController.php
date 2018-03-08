<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use View;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Get User data
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        $userData = [
            'name' => '',
            'email' => '',
            'address' => '',
            'profile_image' => ''
        ];

        $response = [
            'success' => false,
            'user' => $userData
        ];

        $user = $request->user();
        
        if ($user) {
            foreach($userData as $key => $value) {
                $userData[$key] = $user[$key];
            }
            $response = [
                'success' => true,
                'user' => $userData
            ];
        }
        
        return response()->json($response);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        var_dump('czxc');
        exit;
        return view('user.manageProfile');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $imageExtension = $request->image->getClientOriginalExtension();
        $imageName = uniqid() . '.' . $imageExtension;

        $request->image->move(public_path('images'), $imageName);

        $user->profile_image = $imageName;
        $saveResponse = $user->save();

        return response()->json($saveResponse);

    }
}
