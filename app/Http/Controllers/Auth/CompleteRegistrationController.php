<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CompleteRegistration;

class CompleteRegistrationController extends Controller
{
    public function create()
    {
        return view('auth.completion');
    }

    public function store(CompleteRegistration $request)
    {
        $user = $request->user();

        $request->merge(['zipCode' => $request->zip_code]);

        $user->fill($request->all());

        $user->save();

        return redirect()->home();
    }
}
