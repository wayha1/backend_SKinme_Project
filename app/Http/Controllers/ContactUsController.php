<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactusResource;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $contact_us = ContactUs::get();
        return new ContactusResource($contact_us);
    }
    public function store(){

    }
    public function update(){

    }
    public function destroy(){
        
    }
}
