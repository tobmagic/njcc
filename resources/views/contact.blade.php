@extends('layouts.app')
@include('layouts.navigation') 

@section('title', 'Contact Us | Nigeria-Japan Chamber of Commerce')

@section('content')

@once
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
    :root {
        --forest: #1a4228;
        --jade:   #2d6a4f;
        --sage:   #74a98a;
        --cream:  #f9f5ef;
        --muted:  #5a5a5a;
        --border: #e2ddd6;
    }
    .font-display { font-family: 'Playfair Display', Georgia, serif; }
    .font-body    { font-family: 'DM Sans', sans-serif; }

    .reveal { opacity:0; transform:translateY(18px); transition:opacity .65s ease, transform .65s ease; }
    .reveal.visible { opacity:1; transform:none; }
    .reveal-delay-1 { transition-delay:.1s; }
    .reveal-delay-2 { transition-delay:.2s; }
    .reveal-delay-3 { transition-delay:.3s; }

    /* Hero */
    .contact-hero {
        background: var(--forest);
        position: relative; overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Form fields */
    .field-wrap { position: relative; }
    .field-wrap label {
        display: block;
        font-size: .7rem;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--forest);
        margin-bottom: 8px;
    }
    .field-wrap input,
    .field-wrap textarea {
        width: 100%;
        padding: 13px 16px;
        border: 1px solid var(--border);
        background: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: .95rem;
        color: #1c1c1c;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        border-radius: 0;
        -webkit-appearance: none;
        appearance: none;
    }
    .field-wrap input:focus,
    .field-wrap textarea:focus {
        border-color: var(--jade);
        box-shadow: 0 0 0 3px rgba(45,106,79,.08);
    }
    .field-wrap textarea { resize: vertical; min-height: 150px; }
    .field-error { font-size: .78rem; color: #b91c1c; margin-top: 5px; display: block; }

    /* Info item */
    .info-item {
        display: flex; align-items: flex-start; gap: 16px;
        padding: 20px 0;
        border-bottom: 1px solid var(--border);
    }
    .info-item:last-child { border-bottom: none; }
    .info-icon {
        width: 40px; height: 40px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        background: #e8f2ec;
    }
    .info-icon svg { color: var(--jade); }

    /* Map placeholder */
    .map-placeholder {
        width: 100%;
        aspect-ratio: 4/3;
        background: #edeae4;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 10px;
    }

    /* Alert boxes */
    .alert-success {
        padding: 16px 20px;
        background: #f0faf4;
        border-left: 3px solid var(--jade);
        color: var(--forest);
        font-size: .9rem;
        font-weight: 500;
    }
    .alert-error {
        padding: 16px 20px;
        background: #fff5f5;
        border-left: 3px solid #b91c1c;
        color: #7f1d1d;
        font-size: .9rem;
    }
</style>
@endonce

{{-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ --}}
<section class="contact-hero font-body py-24 md:py-32">
    <div class="container mx-auto px-6 lg:px-8 max-w-3xl text-center relative z-10">

        <span class="text-xs font-semibold tracking-[.2em] uppercase mb-5 block" style="color: var(--sage);">
            Reach Out
        </span>

        <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight text-white">
            Get In Touch
        </h1>

        <p class="text-base md:text-lg leading-relaxed max-w-xl mx-auto" style="color: rgba(255,255,255,.6);">
            Whether you're exploring partnerships, seeking investment guidance, or ready to join our network — we're here to help you start your Nigeria&#8209;Japan success story.
        </p>

    </div>
</section>

{{-- ══════════════════════════════════════
     FORM + DETAILS
══════════════════════════════════════ --}}
<section class="font-body py-20 md:py-28 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-20">

            {{-- ── Contact Form (left) ── --}}
            <div class="lg:col-span-7 reveal">

                <p class="text-xs font-semibold tracking-[.2em] uppercase mb-3" style="color: var(--sage);">Send a Message</p>
                <h2 class="font-display text-3xl md:text-4xl font-bold mb-10" style="color: var(--forest);">
                    We'd Love to Hear From You
                </h2>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6" id="contact-form">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="field-wrap">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Your full name">
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field-wrap">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="you@example.com">
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="field-wrap">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required placeholder="How can we help?">
                        @error('subject')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <label for="message">Your Message</label>
                        <textarea name="message" id="message" rows="6" required placeholder="Tell us about your inquiry…">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- reCAPTCHA hidden field — untouched --}}
                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

                    <div class="pt-2">
                        <button type="submit" id="submit-btn"
                                class="inline-flex items-center gap-3 font-semibold text-sm tracking-[.08em] uppercase px-10 py-4 transition-all duration-300 hover:opacity-90 disabled:opacity-60"
                                style="background: var(--forest); color: #fff;">
                            <span id="btn-text">Send Message</span>
                            <svg id="btn-icon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                    </div>

                </form>

                {{-- Success / Error alerts --}}
                @if(session('success'))
                    <div class="alert-success mt-8">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any() || session('error'))
                    <div class="alert-error mt-8">
                        <ul class="space-y-1 list-none">
                            @if(session('error'))
                                <li>{{ session('error') }}</li>
                            @endif
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>

            {{-- ── Info + Map (right) ── --}}
            <div class="lg:col-span-5 reveal reveal-delay-2">

                <p class="text-xs font-semibold tracking-[.2em] uppercase mb-3" style="color: var(--sage);">Contact Details</p>
                <h3 class="font-display text-3xl font-bold mb-8" style="color: var(--forest);">
                    Our Information
                </h3>

                <div class="mb-10">
                    <div class="info-item">
                        <div class="info-icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold tracking-widest uppercase mb-1" style="color: var(--sage);">Address</p>
                            <p class="text-sm leading-relaxed" style="color: var(--muted);">Abuja, Nigeria<br><span class="italic" style="color: #aaa;">Address: Otti Carpets Plaza, 142 Ademola Adetokunbo Crescent, Wuse 2  Abuja 
</span></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold tracking-widest uppercase mb-1" style="color: var(--sage);">Email</p>
                            <a href="mailto:info@nijacc.org" class="text-sm transition-colors hover:underline" style="color: var(--jade);">
                                info@nijacc.org
                            </a>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold tracking-widest uppercase mb-1" style="color: var(--sage);">Phone</p>
                            <p class="text-sm" style="color: var(--muted);">±234-813-424-7347,  +234-807-543-9395</p>
                        </div>
                    </div>
                </div>

                {{-- Map --}}
                <p class="text-xs font-semibold tracking-[.2em] uppercase mb-4" style="color: var(--sage);">Our Location</p>
                <div class="map-placeholder reveal reveal-delay-3">
                    <svg class="w-10 h-10" fill="none" stroke="#b0c4b8" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span class="text-xs tracking-widest uppercase" style="color: #b0c4b8;">Map coming soon</span>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
    {{-- reCAPTCHA v3 — untouched --}}
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>

    <script>
        const form = document.getElementById('contact-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text') || submitBtn;

        if (form) {
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                btnText.innerHTML = 'Sending...';

                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'contact_submit'})
                        .then(function(token) {
                            document.getElementById('g-recaptcha-response').value = token;
                            form.submit();
                        })
                        .catch(function(error) {
                            console.error('reCAPTCHA error:', error);
                            alert('Verification failed. Please try again or refresh the page.');
                            submitBtn.disabled = false;
                            btnText.innerHTML = 'Send Message';
                        });
                });
            });
        }

        @if(session('success'))
            document.getElementById('contact-form').reset();
        @endif

        // Scroll reveal
        document.addEventListener('DOMContentLoaded', () => {
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
            }, { threshold: 0.1 });
            document.querySelectorAll('.reveal').forEach(el => io.observe(el));
        });
    </script>
@endpush