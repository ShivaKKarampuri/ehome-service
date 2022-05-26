<?php
namespace App\Http\Controllers\Auth;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Cookie;

class AdminLoginController extends Controller
{
	use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
	
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
	
    protected function guard()
	{
        return Auth::guard('admin');
    }
	
	public function authenticated(Request $request, $user)
    {		
		if(!empty($request->remember)) {
			\Cookie::queue(\Cookie::make('email', $request->email, 3600));
			\Cookie::queue(\Cookie::make('password', $request->password, 3600));
		} else {
			\Cookie::queue(\Cookie::forget('email'));
			\Cookie::queue(\Cookie::forget('password'));
		}
        return redirect()->intended($this->redirectPath());
    }
	
	public function logout(Request $request)
    {
		Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
		return redirect('/admin');
    }
}
