<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        Mail::to('r4gnarc0de@gmail.com')->send(new ContactMailable($request->all()));

        session()->flash('flash.banner', 'El mensaje se envió satisfactoriamente' );
        session()->flash('flash.bannerStyle','success' );
        
        return redirect()->route('contacts.index');

    }
}
