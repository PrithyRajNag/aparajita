<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyController extends Controller
{

    public function showComLoginForm()
    {
        return view('company_auth.comLogin');
    }

    public function loginValidation(Request $request)
    {
        $employee = CompanyEmployee::where('email', $request->email)->first();

        if ( !$employee ) {
            throw new NotFoundHttpException('Company employee not found');
        }

        if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password])) {
//            Auth::login($employee);
            return redirect()->route('company.dashboard.index');
        }

//        if (Hash::check($request->password, $employee->password)) {
//
//            Auth::login($employee);
//            return redirect()->route('company.dashboard.index');
//        }

        return redirect()->back()->withErrors(['credentials' => 'Check your credentials']);
    }

    public function comLogout()
    {
        Auth::logout();
        Session()->flush();
        return redirect()->route('com-login');
    }
}
