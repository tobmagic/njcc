<style>
    /* ── Navbar ── */
    #main-nav {
        position: fixed; top: 0; left: 0; right: 0;
        z-index: 50;
        transition: background .4s ease, box-shadow .4s ease, padding .3s ease;
        background: transparent;
    }

    /* Scrolled state */
    #main-nav.scrolled {
        background: rgba(20, 42, 28, 0.97);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 1px 0 rgba(255,255,255,.06), 0 4px 24px rgba(0,0,0,.18);
    }

    /* On inner pages (non-hero), always show the filled bar */
    #main-nav.solid {
        background: rgba(20, 42, 28, 0.97);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 1px 0 rgba(255,255,255,.06), 0 4px 24px rgba(0,0,0,.15);
    }

    /* Nav links */
    .nav-link {
        font-family: 'DM Sans', sans-serif;
        font-size: .78rem;
        font-weight: 500;
        letter-spacing: .09em;
        text-transform: uppercase;
        color: rgba(255,255,255,.75);
        text-decoration: none;
        position: relative;
        padding-bottom: 2px;
        transition: color .2s;
    }
    .nav-link::after {
        content: '';
        position: absolute; bottom: -2px; left: 0; right: 0;
        height: 1px;
        background: #74a98a;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .25s ease;
    }
    .nav-link:hover { color: #fff; }
    .nav-link:hover::after,
    .nav-link.active::after { transform: scaleX(1); }
    .nav-link.active { color: #fff; }

    /* Mobile drawer */
    #mobile-drawer {
        position: fixed;
        top: 0; left: 0; bottom: 0;
        width: 300px;
        background: linear-gradient(160deg, #0d2e1a 0%, #1a4228 100%);
        transform: translateX(-100%);
        transition: transform .32s cubic-bezier(.4,0,.2,1);
        z-index: 60;
        display: flex; flex-direction: column;
        overflow-y: auto;
    }
    #mobile-drawer.open { transform: translateX(0); }

    #drawer-overlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,.5);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        z-index: 55;
        opacity: 0; pointer-events: none;
        transition: opacity .32s ease;
    }
    #drawer-overlay.open { opacity: 1; pointer-events: auto; }

    .drawer-link {
        display: flex; align-items: center; justify-content: space-between;
        font-family: 'DM Sans', sans-serif;
        font-size: .9rem;
        font-weight: 500;
        letter-spacing: .04em;
        color: rgba(255,255,255,.8);
        padding: 15px 0;
        border-bottom: 1px solid rgba(255,255,255,.07);
        text-decoration: none;
        transition: color .2s;
    }
    .drawer-link:hover,
    .drawer-link.active { color: #fff; }
    .drawer-link.active .drawer-arrow { opacity: 1; color: #74a98a; }
    .drawer-arrow { opacity: 0; transition: opacity .2s; }
</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<nav id="main-nav" class="{{ request()->is('/') ? '' : 'solid' }}">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10">
        <div class="flex justify-between items-center" style="height: 68px;">

            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/nijacc-logo.png') }}" alt="NIJACC Logo"
                         class="w-auto object-contain" style="height: 40px;">
                </a>
            </div>

            {{-- Desktop links --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}"        class="nav-link {{ request()->is('/')          ? 'active' : '' }}">Home</a>
                <a href="{{ url('/about-us') }}" class="nav-link {{ request()->is('about-us')   ? 'active' : '' }}">About Us</a>
                <a href="{{ url('/services') }}" class="nav-link {{ request()->is('services')   ? 'active' : '' }}">Services</a>
                <a href="{{ url('/resources') }}" class="nav-link {{ request()->is('resources*') ? 'active' : '' }}">Resources</a>
                <a href="{{ url('/contact') }}"
                   class="text-xs font-semibold tracking-[.1em] uppercase px-5 py-2.5 transition-all duration-300 hover:opacity-90"
                   style="background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.3); color: #fff; font-family: 'DM Sans', sans-serif; letter-spacing: .09em;">
                    Contact
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <div class="md:hidden">
                <button id="mobile-menu-button" class="p-2 rounded-md hover:bg-white/10 transition-colors focus:outline-none"
                        aria-label="Open menu">
                    <svg id="hamburger-icon" class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
</nav>

{{-- Mobile overlay --}}
<div id="drawer-overlay"></div>

{{-- Mobile drawer --}}
<div id="mobile-drawer">

    {{-- Drawer header --}}
    <div class="flex items-center justify-between px-7 py-5" style="border-bottom: 1px solid rgba(255,255,255,.08);">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/nijacc-logo.png') }}" alt="NIJACC"
                 class="w-auto object-contain brightness-0 invert" style="height: 34px;">
        </a>
        <button id="drawer-close" class="p-2 rounded hover:bg-white/10 text-white/60 hover:text-white transition-colors focus:outline-none">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Drawer links --}}
    <div class="flex-1 px-7 py-6">
        @foreach([['/', 'Home'], ['/about-us', 'About Us'], ['/services', 'Services'], ['/resources', 'Resources'], ['/contact', 'Contact']] as [$path, $label])
        <a href="{{ url($path) }}"
           class="drawer-link {{ request()->is(ltrim($path, '/') ?: '/') ? 'active' : '' }}">
            {{ $label }}
            <svg class="drawer-arrow w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @endforeach
    </div>

    {{-- Drawer footer --}}
    <div class="px-7 pb-8 pt-4" style="border-top: 1px solid rgba(255,255,255,.07);">
        <p class="text-xs tracking-[.15em] uppercase" style="color: rgba(255,255,255,.25); font-family: 'DM Sans', sans-serif;">
            Nigeria-Japan Chamber of Commerce
        </p>
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const nav      = document.getElementById('main-nav');
    const btn      = document.getElementById('mobile-menu-button');
    const drawer   = document.getElementById('mobile-drawer');
    const overlay  = document.getElementById('drawer-overlay');
    const closeBtn = document.getElementById('drawer-close');
    const isHero   = nav.classList.contains('solid') === false;

    /* ── Scroll behaviour (hero pages only) ── */
    if (isHero) {
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 40);
        }, { passive: true });
    }

    /* ── Drawer open/close ── */
    const openDrawer = () => {
        drawer.classList.add('open');
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    };
    const closeDrawer = () => {
        drawer.classList.remove('open');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    };

    btn?.addEventListener('click', openDrawer);
    closeBtn?.addEventListener('click', closeDrawer);
    overlay?.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDrawer(); });
});
</script>
@endpush