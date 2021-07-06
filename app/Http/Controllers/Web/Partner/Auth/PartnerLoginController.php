<?php

namespace App\Http\Controllers\Web\Partner\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class PartnerLoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    public function __construct()
    {
        $this->middleware('guest:partner')->except('logout');
    }

    /**
     * return login form for admin
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('partner.auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $data = $this->getCredentials($request);

        // login success
        if ($this->guard()->attempt($data,$request->has('remember_me'))){
            return redirect()->to($this->redirectTo);
        }

        //login fails
        session()->flash('error',trans('auth.failed'));
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return Application|JsonResponse|RedirectResponse|Redirector|mixed
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect()->route('partner.login.index');
    }


    /**
     * The admin has logged out of the application.
     *
     * @param Request $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }


    /**
     * get the credential for sign in
     *
     * @param Request $request
     * @return array
     */
    private function getCredentials(Request $request): array
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
    }

    private function guard()
    {
        return auth('partner');
    }

}
