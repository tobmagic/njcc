<?php

namespace App\Http\Controllers;

use App\Models\Delegate;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showForm($program = 'Nigeria Business Forum in Japan 2026')
    {
        return view('pages.register', compact('program'));
    }
public function store(Request $request)
{
    $validated = $request->validate([
    'full_name' => 'required|string',
    'email' => 'required|email',
    'phone' => 'required',
    'residential_address' => 'nullable|string',
    'company_name' => 'nullable|string',
    'job_title' => 'nullable|string',        
    'organization_address' => 'nullable|string', 
    'business_products' => 'nullable|string',
    'payment_proof' => 'required|image|mimes:jpg,jpeg,png,pdf|max:2048', 
]);

    if ($request->hasFile('payment_proof')) {
        $path = $request->file('payment_proof')->store('proofs', 'public');
        $validated['payment_proof'] = $path;
    }

    $validated['program_name'] = $request->program_name;

    \App\Models\Delegate::create($validated);

    return back()->with('success', 'Registration submitted successfully. We will verify your payment and contact you shortly.');
}

        
   
}