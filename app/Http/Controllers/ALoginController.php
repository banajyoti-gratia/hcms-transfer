<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;
use View;

use Illuminate\Http\Request;

class ALoginController extends Controller {
    public function index( Request $request ) {
        return view( 'pages.login' );
    }

    public function postLogin( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'username' => 'required',
            'password' => 'required'

        ] );
        $username = $request->username;
        $password = $request->password;
        if ( $validator->fails() ) {
            return response()->json( [
                'status' => false,
                'errors' => $validator->errors()
            ] );
        } else {

            $check = User::where( 'username', $username )->first();
            if ( $check ) {
                if ( Hash::check( $password, $check->password ) ) {
                    if ( User::where( 'is_bdo', 1 ) ) {
                        Auth::login( $check );
                        $massage = 'You are successfully Logged In.';
                        return response()->json( [
                            'status' => true,
                            'message' => $massage,
                            'redirect' => url( '/dashboard' )
                        ] );
                    }
                    else {
                        return response()->json( [
                            'status' => false,
                            'errors' => [ 'Invalid credentials' ]
                        ] );
                    }
                } else {
                    return response()->json( [
                        'status' => false,
                        'errors' => [ 'Email & Password Doesnot Match.' ]
                    ] );
                }
            }
            return response()->json( [
                'status' => false,
                'errors' => [ 'Invalid credentials' ]
            ] );
        }
    }

    public function index_dashboard( Request $request ) {
        return view( 'pages.dashboard' );
    }

    public function error() {
        return view( 'layouts.error_pages.error_404' );
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect( '/login' );
    }
}
