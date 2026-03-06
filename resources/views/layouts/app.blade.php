<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Nigeria-Japan Chamber of Commerce')</title>

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
@once
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
@endonce

<!-- Your custom CSS variables & classes -->
<style>
    :root {
        --forest:   #1a4228;
        --jade:     #2d6a4f;
        --sage:     #74a98a;
        --cream:    #f9f5ef;
        --ink:      #1c1c1c;
        --muted:    #5a5a5a;
        --border:   #e2ddd6;
    }
    .font-display { font-family: 'Playfair Display', Georgia, serif; }
    .font-body    { font-family: 'DM Sans', sans-serif; }

    /* Diamond rule (used in many places) */
    .rule-diamond {
        display: flex; align-items: center; gap: 12px;
        margin: 0 auto 2rem;
        width: fit-content;
    }
    .rule-diamond::before,
    .rule-diamond::after {
        content: '';
        display: block;
        width: 60px; height: 1px;
        background: var(--sage);
    }
    .rule-diamond span {
        display: block; width: 8px; height: 8px;
        background: var(--jade);
        transform: rotate(45deg);
    }

    /* Reveal animation (restored to original state) */
.reveal { 
    opacity: 0; 
    transform: translateY(24px); 
    transition: opacity .7s ease, transform .7s ease; 
}
.reveal.visible { 
    opacity: 1; 
    transform: none; 
}
.reveal-delay-1 { transition-delay: .12s; }
.reveal-delay-2 { transition-delay: .24s; }
.reveal-delay-3 { transition-delay: .36s; }
</style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        {{-- @include('layouts.navigation')  <!-- your nav bar --> --}}

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('partials.footer')  <!-- your footer -->
    </div>

    @stack('scripts')
    
    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-6 shadow-2xl z-50 transition-transform duration-500 transform translate-y-full">
    <div class="container mx-auto max-w-5xl flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-600">
            We use cookies to improve your experience. By clicking "Accept All", you agree to our 
            <a href="{{ url('/privacy-policy') }}" class="text-[var(--jade)] underline">Privacy Policy</a>.
        </p>
        <div class="flex gap-3">
            <button onclick="handleCookie('reject')" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-800">Reject</button>
            <button onclick="handleCookie('accept')" class="px-6 py-2 text-sm bg-[var(--forest)] text-white rounded-full">Accept All</button>
        </div>
    </div>
</div>

<script>
    // Simple script to show and hide the banner
    window.onload = () => {
        if (!localStorage.getItem('cookies-accepted')) {
            document.getElementById('cookie-banner').classList.remove('translate-y-full');
        }
    };

    function handleCookie(action) {
        localStorage.setItem('cookies-accepted', action);
        document.getElementById('cookie-banner').classList.add('translate-y-full');
    }
</script>
</body>
</html>