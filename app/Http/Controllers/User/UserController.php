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
        $success = false;
        $userData = [
            'name' => '',
            'email' => '',
            'address' => '',
            'profile_image' => ''
        ];

        $user = $request->user();
        
        if ($user) {
            foreach($userData as $key => $value) {
                $userData[$key] = $user[$key];
            }
            $success = true;
        }
        $response = [
            'success' => $success,
            'user' => $userData
        ];
        
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
        $imageUploaded = false;
        if ($request['user']) {
            $userData = json_decode($request['user'], true);
            foreach($userData as $key => $data) {
                $request[$key] = $data;
            }
        }

        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $imageUploaded = true;
        }

        $request->validate($rules);

        $user = $request->user();
        $user->name = $request['name'];
        $user->address = $request['address'];

        if ($imageUploaded) {
            $imageExtension = $request->image->getClientOriginalExtension();
            $imageName = uniqid() . '.' . $imageExtension;
            $request->image->move(public_path('images'), $imageName);
            $user->profile_image = $imageName;
        }
        
        $saveResponse = $user->save();

        $response = [
            'success' => $saveResponse,
            'message' => 'Profile updated successfully.'
        ];

        return response()->json($saveResponse);

    }
}
