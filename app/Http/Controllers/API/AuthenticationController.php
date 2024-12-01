<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Hash;

class AuthenticationController extends Controller
{
    /** register new account */
    public function register(Request $request)
    {
        $request->validate([
            'id_usuario'     => 'required|min:4|unique:users',
            'nombre'     => 'required|min:4',
            'apellidoP'     => 'required|min:4',
            'apellidoM'     => 'required|min:4',
            'email'    => 'required|string|email|max:255',
            'password' => 'required|min:5',
            'rol'     => 'required|min:4',
        ]);
 
        $user = new User();
        $user->id_usuario  = $request->id_usuario;
        $user->nombre       = $request->nombre ;
        $user->apellidoP    = $request->apellidoP ;
        $user->apellidoM    = $request->apellidoM;
        $user->email        = $request->email ;
        $user->password     = Hash::make($request->password);
        $user->rol          = $request->rol;
        $user->save();

        $data = [];
        $data['response_code']  = '200';
        $data['status']         = 'success';
        $data['message']        = 'success Register';
        return response()->json($data);
    }

    /**
     * Login Req
     */
    public function login(Request $request)
{
    $request->validate([
        'id_usuario' => 'required|string',
        'password' => 'required|string',
    ]);

    try {
        $credentials = ['id_usuario' => $request->id_usuario, 'password' => $request->password];

        \Log::info('Attempting login with credentials', $credentials);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $accessToken = $user->createToken($user->id_usuario)->accessToken;

            $data = [
                'response_code' => '200',
                'status' => 'success',
                'message' => 'success Login',
                'user_info' => $user,
                'token' => $accessToken
            ];

            \Log::info('Login successful', $data);

            return response()->json($data);
        } else {
            $data = [
                'response_code' => '401',
                'status' => 'failed',
                'message' => 'Unauthorized',
            ];

            \Log::info('Login failed', $data);

            return response()->json($data);
        }
    } catch(\Exception $e) {
        \Log::error('Exception during login', ['exception' => $e]);
        $data = [
            'response_code' => '401',
            'status' => 'error',
            'message' => 'error afuera',
        ];
        return response()->json($data);
    }
}


    /** user info */
    public function userInfo() 
    {
        try {
            $userDataList = User::latest()->paginate(10);
            $data = [];
            $data['response_code']  = '200';
            $data['status']         = 'success';
            $data['message']        = 'success get user list';
            $data['data_user_list'] = $userDataList;
            return response()->json($data);
        } catch(\Exception $e) {
            \Log::info($e);
            $data = [];
            $data['response_code']  = '400';
            $data['status']         = 'error';
            $data['message']        = 'fail get user list';
            return response()->json($data);
        }
    }

    public function user(Request $request)
    {
        try {
            $user = $request->id_usuario;
            
            $userDataList = User::where('id_usuario', $user)->latest()->paginate(10);
            $data = [];
            $data['response_code']  = '200';
            $data['status']         = 'success';
            $data['message']        = 'success get user list';
            $data['data_user_list'] = $userDataList;
            $data['id_usuario'] = $user;
            return response()->json($data);
        } catch(\Exception $e) {
            \Log::info($e);
            $data = [];
            $data['response_code']  = '400';
            $data['status']         = 'error';
            $data['message']        = 'fail get user list';
            return response()->json($data);
        }
    }    
}
