<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index (){
        return view('contacts.index');
    }

    public function store(Request $request){
        $request->validate([
            'name'=> 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        return redirect()->route('contacts.index')->with('Tu mensaje ha sido enviado');
    }
}
