<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function Login()
    {
        return view('auth.login');
    }

    public function loginstore(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validateUser->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Validation fails',
                'error' => $validateUser->errors()
            ], 401);
        }

        if(!Auth::attempt($request->only(['email', 'password'])))
        {
            return response()->json([
                'success' => false,
                'message' => 'Credential does not found in our records',
            ], 401);
        }
        $user = User::where('email', $request->input('email'))->first();
        $user->tokens()->delete();

        $token = $user->createToken($user->id)->plainTextToken;
        return response()->json([
            'name' => $user->name,
            'access_token' => $token,
            'message' => 'Login successfully',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

   
   


}
