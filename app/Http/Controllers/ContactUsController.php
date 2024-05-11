<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\UpdateContactusRequest;
use App\Http\Resources\ContactusResource;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    public function index(){
        $contact_us = ContactUs::get();
        return new ContactusResource($contact_us);
    }
    public function store(ContactUsRequest $request){
        $validated = $request-> validated();
        $validated['user_id'] = Auth::id();
        $contactus = ContactUs::create($validated);

        return response()->json([
            'message' => 'Contact Us post Success',
            'data' => new ContactusResource($contactus)
        ]);
    }
    public function update(UpdateContactusRequest $request, ContactUs $contactUs){
        $contactUs -> update($request->validated());
        return response()->json([
            'message' => 'Contact Us updat work',
            'data' => new ContactusResource($contactUs)
        ]);
    }
    public function destroy(ContactUs $contactUs){
        $contactUs->delete();
        return response()->json([
            'message' => 'data of Contact us Was delete'
        ],  204);
    }
}
