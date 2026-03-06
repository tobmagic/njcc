<section class="relative flex flex-col overflow-hidden" style="height: 100svh; min-height: 640px;">

    <!-- Sliding Background Images -->
    <div class="absolute inset-0 z-0">
        <div class="hero-slideshow absolute inset-0">

            <!-- Slide 1 -->
            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out"
                 style="background-image: url('https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
                        background-size: cover; background-position: center center; background-repeat: no-repeat;">
                <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.55) 100%);"></div>
            </div>

            <!-- Slide 2 -->
            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out"
                 style="background-image: url('{{ asset('images/hero/japan1.jpg') }}');
                        background-size: cover; background-position: center center; background-repeat: no-repeat;">
                <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.55) 100%);"></div>
            </div>

            <!-- Slide 3 -->
            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out"
                 style="background-image: url('{{ asset('images/hero/abuja1.jpg') }}');
                        background-size: cover; background-position: center center; background-repeat: no-repeat;">
                <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.55) 100%);"></div>
            </div>

            <!-- Slide 4 -->
            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out"
                 style="background-image: url('{{ asset('images/hero/abuja2.jpg') }}');
                        background-size: cover; background-position: center center; background-repeat: no-repeat;">
                <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.55) 100%);"></div>
            </div>

            <!-- Slide 5 -->
            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out"
                 style="background-image: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
                        background-size: cover; background-position: center center; background-repeat: no-repeat;">
                <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.55) 100%);"></div>
            </div>

        </div>
    </div>

    <style>
        /* ── Typewriter ── */
        .typewriter-cursor::after {
            content: '|';
            display: inline-block;
            margin-left: 2px;
            animation: blink 0.75s step-end infinite;
            opacity: 1;
        }
        .typewriter-cursor.done::after { animation: none; opacity: 0; }
        @keyframes blink { 0%,100%{ opacity:1 } 50%{ opacity:0 } }

        /* ── Hero text entrance ── */
        .hero-sub {
            opacity: 0;
            transform: translateY(12px);
            transition: opacity .7s ease .2s, transform .7s ease .2s;
        }
        .hero-sub.show { opacity: 1; transform: none; }
        .hero-cta {
            opacity: 0;
            transform: translateY(12px);
            transition: opacity .7s ease .5s, transform .7s ease .5s;
        }
        .hero-cta.show { opacity: 1; transform: none; }

        /* ── Slide counter dots ── */
        .slide-dot {
            width: 6px; height: 6px;
            background: rgba(255,255,255,0.4);
            border-radius: 9999px;
            transition: all .4s ease;
            cursor: pointer;
        }
        .slide-dot.active {
            width: 24px;
            background: rgba(255,255,255,0.95);
        }

        /* ── Mobile menu — deep forest green, not pure black ── */
        #mobile-menu {
            background: linear-gradient(160deg, #0d2e1a 0%, #1a4228 100%);
        }

        /* ── CTA button sharp style ── */
        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.5);
            color: #fff;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            font-size: .85rem;
            padding: 14px 32px;
            transition: background .3s, border-color .3s;
        }
        .hero-btn:hover {
            background: rgba(255,255,255,0.22);
            border-color: rgba(255,255,255,0.85);
        }
        @media (min-width: 768px) {
            .hero-btn { font-size: .95rem; padding: 16px 40px; }
        }
    </style>

    <!-- Navigation -->
    <nav class="relative z-30 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('images/nijacc-logo.png') }}" alt="NIJACC Logo" class="h-12 w-auto object-contain">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-10">
                    <a href="{{ url('/') }}" class="text-white hover:text-white/80 font-medium transition-colors {{ request()->is('/') ? 'underline underline-offset-4 decoration-white/70' : '' }}">Home</a>
                    <a href="{{ url('/about-us') }}" class="text-white hover:text-white/80 font-medium transition-colors {{ request()->is('about-us') ? 'underline underline-offset-4 decoration-white/70' : '' }}">About Us</a>
                    <a href="{{ url('/services') }}" class="text-white hover:text-white/80 font-medium transition-colors {{ request()->is('services') ? 'underline underline-offset-4 decoration-white/70' : '' }}">Services</a>
                    <a href="{{ url('/resources') }}" class="text-white hover:text-white/80 font-medium transition-colors {{ request()->is('resources*') ? 'underline underline-offset-4 decoration-white/70' : '' }}">Resources</a>
                    <a href="{{ url('/contact') }}" class="text-white hover:text-white/80 font-medium transition-colors {{ request()->is('contact') ? 'underline underline-offset-4 decoration-white/70' : '' }}">Contact</a>
                </div>

                <!-- Mobile Hamburger -->
                <div class="md:hidden">
                    <button id="mobile-toggle" class="text-white p-2 rounded-md hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/30">
                        <svg class="h-7 w-7 hamburger-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-7 w-7 close-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="fixed inset-y-0 left-0 w-80 transform -translate-x-full transition-transform duration-300 ease-in-out z-50 md:hidden overflow-y-auto">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between p-6" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/nijacc-logo.png') }}" alt="NIJACC" class="h-10 w-auto object-contain brightness-0 invert">
                    </a>
                    <button id="mobile-close" class="text-white p-2 rounded-md hover:bg-white/10">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 px-8 py-10 space-y-1">
                    @foreach ([['/', 'Home'], ['/about-us', 'About Us'], ['/services', 'Services'], ['/resources', 'Resources'], ['/contact', 'Contact']] as [$path, $label])
                    <a href="{{ url($path) }}"
                       class="flex items-center justify-between py-4 text-white text-base font-medium transition-colors hover:text-white/70"
                       style="border-bottom: 1px solid rgba(255,255,255,0.07);">
                        {{ $label }}
                        <svg class="w-4 h-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @endforeach
                </div>
                <div class="px-8 pb-10 pt-2" style="border-top: 1px solid rgba(255,255,255,0.07);">
                    <p class="text-xs tracking-widest uppercase" style="color: rgba(255,255,255,0.3);">Nigeria-Japan Chamber of Commerce</p>
                </div>
            </div>
        </div>

        <!-- Mobile Overlay -->
        <div id="mobile-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 opacity-0 invisible transition-opacity duration-300 md:hidden pointer-events-none"></div>
    </nav>

    <!-- Hero Text -->
    <div class="relative z-10 flex flex-col justify-center items-center text-center px-6 flex-grow">

        <!-- Eyebrow label -->
        <p class="hero-sub text-xs sm:text-sm font-semibold tracking-[0.2em] uppercase text-white/60 mb-5">
            Nigeria &mdash; Japan Chamber of Commerce
        </p>

        <!-- Typewriter headline -->
        <h1 id="hero-heading"
            class="typewriter-cursor text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white mb-6 md:mb-8 leading-tight"
            style="min-height: 1.2em; font-family: Georgia, 'Times New Roman', serif; max-width: 900px;">
        </h1>

        <p class="hero-sub text-base sm:text-lg md:text-xl text-white/80 mb-10 md:mb-12 max-w-2xl mx-auto leading-relaxed">
            After 29 years of fostering bilateral trade, we're returning stronger — with renewed vision and unstoppable momentum.
        </p>

        <div class="hero-cta flex flex-col sm:flex-row items-center gap-4">
            <a href="{{ url('/about-us') }}" class="hero-btn">
                Discover Our Story
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ url('/contact') }}"
               class="text-white/70 hover:text-white text-sm font-medium tracking-wide transition-colors underline underline-offset-4 decoration-white/30 hover:decoration-white/70">
                Get in touch
            </a>
        </div>

    </div>

    <!-- Slide dots -->
    <div id="slide-dots" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex items-center gap-2">
        <!-- Injected by JS -->
    </div>

    <!-- Scroll arrow (fades out on scroll) -->
    <div id="scroll-indicator" class="absolute bottom-8 right-8 z-10 transition-opacity duration-500">
        <div class="flex flex-col items-center gap-1 animate-bounce">
            <span class="text-white/40 text-xs tracking-widest uppercase" style="font-size:9px; letter-spacing:.15em;">Scroll</span>
            <svg class="w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </div>

</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    /* ── Slideshow ── */
    const slides   = document.querySelectorAll('.hero-slideshow .slide');
    const dotsWrap = document.getElementById('slide-dots');
    let current    = 0;
    let dots       = [];

    if (slides.length > 0) {
        // Build dots
        slides.forEach((_, i) => {
            const d = document.createElement('button');
            d.className = 'slide-dot' + (i === 0 ? ' active' : '');
            d.setAttribute('aria-label', 'Go to slide ' + (i + 1));
            d.addEventListener('click', () => goTo(i));
            dotsWrap.appendChild(d);
            dots.push(d);
        });

        slides[current].style.opacity = '1';

        function goTo(next) {
            if (next === current) return;
            const prev = current;
            current = next;
            slides[next].style.opacity = '1';
            slides[next].style.zIndex  = '1';
            setTimeout(() => {
                slides[prev].style.opacity = '0';
                slides[prev].style.zIndex  = '0';
                slides[next].style.zIndex  = '0';
            }, 1000);
            dots.forEach((d, i) => d.classList.toggle('active', i === current));
        }

        setInterval(() => goTo((current + 1) % slides.length), 5000);
    }

    /* ── Typewriter ── */
    const heading = document.getElementById('hero-heading');
    const text    = 'A New Era of Nigeria\u2011Japan Trade Relations';
    let   idx     = 0;

    function type() {
        if (idx <= text.length) {
            heading.textContent = text.slice(0, idx);
            idx++;
            setTimeout(type, idx < 10 ? 60 : 55); 
        } else {
            heading.classList.add('done');
            document.querySelectorAll('.hero-sub, .hero-cta').forEach(el => el.classList.add('show'));
        }
    }
    setTimeout(() => {
        document.querySelector('.hero-sub').classList.add('show');
        setTimeout(type, 400);
    }, 300);

    /* ── Scroll indicator fade ── */
    const scrollBtn = document.getElementById('scroll-indicator');
    window.addEventListener('scroll', () => {
        scrollBtn.style.opacity = window.scrollY > 60 ? '0' : '1';
    }, { passive: true });
    scrollBtn.addEventListener('click', () => {
        window.scrollBy({ top: window.innerHeight * 0.85, behavior: 'smooth' });
    });

    /* ── Mobile menu ── */
    const toggleBtn = document.getElementById('mobile-toggle');
    const closeBtn  = document.getElementById('mobile-close');
    const menu      = document.getElementById('mobile-menu');
    const overlay   = document.getElementById('mobile-overlay');
    const hamburger = document.querySelector('.hamburger-icon');
    const closeIcon = document.querySelector('.close-icon');

    const openMenu = () => {
        menu.classList.remove('-translate-x-full');
        menu.classList.add('translate-x-0');
        overlay.classList.remove('opacity-0', 'invisible', 'pointer-events-none');
        overlay.classList.add('opacity-100', 'visible', 'pointer-events-auto');
        hamburger.classList.add('hidden');
        closeIcon.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    const closeMenu = () => {
        menu.classList.remove('translate-x-0');
        menu.classList.add('-translate-x-full');
        overlay.classList.remove('opacity-100', 'visible', 'pointer-events-auto');
        overlay.classList.add('opacity-0', 'invisible', 'pointer-events-none');
        hamburger.classList.remove('hidden');
        closeIcon.classList.add('hidden');
        document.body.style.overflow = '';
    };

    toggleBtn?.addEventListener('click', openMenu);
    closeBtn?.addEventListener('click', closeMenu);
    overlay?.addEventListener('click', closeMenu);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
    menu?.addEventListener('click', e => e.stopPropagation());
});
</script>
@endpush