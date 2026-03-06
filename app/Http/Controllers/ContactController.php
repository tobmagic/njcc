<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

  public function send(Request $request)
  
{
    //dumb the values 
    // dump($request->all());
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|min:10',
        // 'g-recaptcha-response' => 'required|recaptcha', // Custom rule from earlier
    ]);

    Message::create($validated);

    return back()->with('success', 'Thank you! Your message has been received. We will get back to you soon.');
}
}
