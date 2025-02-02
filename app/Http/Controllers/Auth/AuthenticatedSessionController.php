<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Identificacion;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // $query = User::all()->where('document',$request['document']);
        $query = User::where('document', $request['document'])->get();

        // $idRoute = $query[0]['id_dependencia'];

        // return $idRoute;

        // return $query;
        // $request->authenticate();

        // $request->session()->regenerate();
        if($query[0]['rol_id'] == 1){

            $request->authenticate();

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);

        } else {
            
            if($query[0]['id_subdependencia'] == null){
                $idRoute = $query[0]['id_dependencia'];

                $request->authenticate();

                $request->session()->regenerate();

                return redirect('/subdependencia/'.$idRoute.'/index');
            }else{
                $idRoute = $query[0]['id_subdependencia'];

                $request->authenticate();

                $request->session()->regenerate();

                return redirect('/subdepe/'.$idRoute.'/index');
            }
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
