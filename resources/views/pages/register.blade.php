@extends('layouts.app')

@section('title', 'Delegation Registration | NIJACC')

@section('content')

<style>
    .input-modern {
        @apply w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm transition-all duration-200;
    }
    .input-modern:focus {
        @apply outline-none ring-2 ring-[#1a4228]/20 border-[#1a4228];
    }
    .input-error {
        @apply border-red-500 ring-red-100 focus:border-red-500 focus:ring-red-200;
    }
    .card {
        @apply bg-white rounded-2xl shadow-sm border border-gray-100;
    }
</style>

{{-- HERO --}}
<section class="relative py-20 bg-gradient-to-br from-[#1a4228] to-[#0f2a1a] text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('/images/pattern.svg')]"></div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <p class="uppercase tracking-[0.3em] text-xs text-gray-300 mb-4">Official Registration Portal</p>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $program }}</h1>
        <p class="text-gray-300 text-lg max-w-xl mx-auto">Secure your slot by completing the registration and uploading your payment confirmation.</p>
    </div>
</section>

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- SUCCESS/ERROR MESSAGES (MOVED HERE FOR MOBILE VISIBILITY) --}}
        @if(session('success'))
            <div class="mb-8 p-4 rounded-xl bg-green-50 text-green-700 border border-green-100 flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 p-4 rounded-xl bg-red-50 text-red-700 border border-red-100 text-sm flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span class="font-medium">Please correct the errors in the form below to proceed.</span>
            </div>
        @endif

        <div class="grid lg:grid-cols-12 gap-10">
            
            {{-- PAYMENT SIDEBAR --}}
            <div class="lg:col-span-5 space-y-6">
                <h2 class="text-xl font-semibold text-gray-800">Payment Details</h2>
                
                {{-- PRIMARY ACCOUNT --}}
                <div class="card p-6 border-l-4 border-[#1a4228]">
                    <p class="text-xs uppercase text-gray-400 mb-4 tracking-widest">Primary Account</p>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-400">Account Name</p>
                            <p class="font-semibold text-gray-900">Nigeria Japan Chamber of Commerce</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-400">Account Number</p>
                                <p class="text-lg font-semibold tracking-wide">5601705447</p>
                            </div>
                            <button onclick="copyText('5601705447')" class="px-3 py-2 text-sm rounded-lg border hover:bg-gray-50 transition">Copy</button>
                        </div>
                    </div>
                </div>

                {{-- ALTERNATIVE ACCOUNTS --}}
                <div class="card p-6">
                    <p class="text-xs uppercase text-gray-400 mb-4 tracking-widest">Alternative Accounts</p>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Naira (Fidelity)</span>
                            <strong class="text-gray-900">4010341581</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">USD (Fidelity)</span>
                            <strong class="text-gray-900">5090224708</strong>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-amber-50 border border-amber-100 text-sm text-amber-800">
                    Upload a clear receipt after payment (Image or PDF).
                </div>
            </div>

            {{-- FORM SECTION --}}
            <div class="lg:col-span-7">
                <div class="card p-8 md:p-10">
                    <form id="multiStepForm" action="{{ route('register.delegate.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" name="program_name" value="{{ $program }}">

                        {{-- STEP INDICATOR --}}
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-3">
                                <div id="step1-indicator" class="w-8 h-8 flex items-center justify-center rounded-full {{ $errors->any() && !$errors->has('payment_proof') ? 'bg-red-500' : 'bg-[#1a4228]' }} text-white text-sm font-bold">1</div>
                                <span class="text-sm font-medium text-gray-700">Information</span>
                            </div>
                            <div class="flex-1 h-[1px] bg-gray-200 mx-4"></div>
                            <div class="flex items-center gap-3">
                                <div id="step2-indicator" class="w-8 h-8 flex items-center justify-center rounded-full {{ $errors->has('payment_proof') ? 'bg-[#1a4228] text-white' : 'bg-gray-200 text-gray-500' }} text-sm font-bold">2</div>
                                <span class="text-sm font-medium text-gray-400">Payment</span>
                            </div>
                        </div>

                        {{-- STEP 1: PERSONAL & ORG --}}
                        <div id="step1" class="{{ $errors->has('payment_proof') ? 'hidden' : '' }} space-y-8">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 mb-4">Personal Information</h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="Full Name" class="input-modern @error('full_name') input-error @enderror">
                                        @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email Address" class="input-modern @error('email') input-error @enderror">
                                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 gap-6 mt-6">
                                    <div>
                                        <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="Phone Number" class="input-modern @error('phone') input-error @enderror">
                                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <input type="text" name="residential_address" value="{{ old('residential_address') }}" placeholder="Residential Address" class="input-modern">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 mb-4">Organization Details</h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Company Name" class="input-modern">
                                    <input type="text" name="job_title" value="{{ old('job_title') }}" placeholder="Position / Title" class="input-modern">
                                </div>
                                <div class="mt-6">
                                    <input type="text" name="organization_address" value="{{ old('organization_address') }}" placeholder="Company Address" class="input-modern">
                                </div>
                                <div class="mt-6">
                                    <textarea name="business_products" rows="3" placeholder="Business Products / Services" class="input-modern">{{ old('business_products') }}</textarea>
                                </div>
                            </div>

                            <button type="button" onclick="nextStep()" class="w-full py-4 text-white font-semibold bg-[#1a4228] hover:opacity-90 transition rounded-xl">
                                Continue to Payment 
                            </button>
                        </div>

                        {{-- STEP 2: PAYMENT --}}
                        <div id="step2" class="{{ $errors->has('payment_proof') ? '' : 'hidden' }} space-y-6">
                            <h3 class="text-sm font-semibold text-gray-700">Payment Confirmation</h3>
                            <div class="border-2 border-dashed {{ $errors->has('payment_proof') ? 'border-red-300 bg-red-50' : 'border-gray-200' }} rounded-xl p-6 text-center hover:border-[#1a4228] transition">
                                <p class="text-sm font-medium text-gray-700 mb-2">Upload Payment Receipt</p>
                                <input type="file" name="payment_proof" required class="block w-full text-sm mt-2">
                                @error('payment_proof') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex gap-4">
                                <button type="button" onclick="prevStep()" class="w-1/2 py-3 rounded-xl border text-gray-600 hover:bg-gray-50 transition">Back</button>
                                <button type="submit" class="w-1/2 py-3 rounded-xl text-white font-semibold bg-gradient-to-r from-[#1a4228] to-[#14532d] transition">Submit Registration</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="toast" class="fixed bottom-5 right-5 hidden bg-black text-white px-4 py-2 rounded-lg text-sm">Copied!</div>

<script>
function copyText(text) {
    navigator.clipboard.writeText(text);
    const toast = document.getElementById('toast');
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 2000);
}

function nextStep() {
    const step1 = document.getElementById('step1');
    const requiredFields = step1.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        field.classList.remove('border-red-500', 'ring-red-100');
        
        if (!field.value.trim()) {
            field.classList.add('border-red-500', 'ring-red-100');
            isValid = false;
        }

        if (field.type === 'email' && field.value.trim()) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(field.value)) {
                field.classList.add('border-red-500', 'ring-red-100');
                isValid = false;
            }
        }
    });

    if (!isValid) {
        alert('Please fill all required fields correctly.');
        return;
    }

    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
    document.getElementById('step1-indicator').classList.replace('bg-[#1a4228]', 'bg-green-500');
    document.getElementById('step2-indicator').classList.replace('bg-gray-200', 'bg-[#1a4228]');
    document.getElementById('step2-indicator').classList.replace('text-gray-500', 'text-white');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function prevStep() {
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
    document.getElementById('step1-indicator').classList.replace('bg-green-500', 'bg-[#1a4228]');
    document.getElementById('step2-indicator').classList.replace('bg-[#1a4228]', 'bg-gray-200');
    document.getElementById('step2-indicator').classList.replace('text-white', 'text-gray-500');
}
</script>

@endsection