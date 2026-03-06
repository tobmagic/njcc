@extends('layouts.app')
@include('layouts.navigation')

@section('title', 'Services | Nigeria-Japan Chamber of Commerce')

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

    .reveal { opacity:0; transform:translateY(20px); transition:opacity .65s ease, transform .65s ease; }
    .reveal.visible { opacity:1; transform:none; }
    .reveal-delay-1 { transition-delay:.1s; }
    .reveal-delay-2 { transition-delay:.2s; }
    .reveal-delay-3 { transition-delay:.3s; }
    .reveal-delay-4 { transition-delay:.4s; }

    /* Hero */
    .services-hero {
        background: var(--forest);
        position: relative; overflow: hidden;
    }
    .services-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Service card */
    .service-card {
        display: grid;
        grid-template-columns: 1fr;
        border: 1px solid var(--border);
        overflow: hidden;
        transition: border-color .3s, box-shadow .3s;
        background: #fff;
    }
    .service-card:hover {
        border-color: var(--sage);
        box-shadow: 0 8px 40px rgba(26,66,40,.07);
    }

    /* Alternating layout on desktop */
    @media (min-width: 1024px) {
        .service-card { grid-template-columns: 1fr 1fr; }
        .service-card.reverse { direction: rtl; }
        .service-card.reverse > * { direction: ltr; }
    }

    .service-card-image {
        aspect-ratio: 4/3;
        overflow: hidden;
        background: #dce8e1;
    }
    @media (min-width: 1024px) {
        .service-card-image { aspect-ratio: unset; min-height: 340px; }
    }
    .service-card-image img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform .6s ease;
    }
    .service-card:hover .service-card-image img { transform: scale(1.04); }

    .service-card-body {
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    @media (min-width: 768px) { .service-card-body { padding: 3.5rem; } }

    /* Number badge */
    .service-num {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1;
        color: #e8f2ec;
        margin-bottom: .5rem;
        display: block;
    }

    /* Divider */
    .card-rule {
        width: 36px; height: 2px;
        background: var(--jade);
        margin: 1rem 0 1.5rem;
    }
</style>
@endonce

{{-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ --}}
<section class="services-hero font-body py-24 md:py-32">
    <div class="container mx-auto px-6 lg:px-8 max-w-3xl text-center relative z-10">

        <span class="text-xs font-semibold tracking-[.2em] uppercase mb-5 block" style="color: var(--sage);">
            Comprehensive Support
        </span>

        <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight text-white">
            Our Services
        </h1>

        <p class="text-base md:text-lg leading-relaxed max-w-xl mx-auto" style="color: rgba(255,255,255,.6);">
            End-to-end assistance for businesses looking to invest, partner, or expand between Nigeria and Japan — from market entry to long-term growth.
        </p>

    </div>
</section>

{{-- ══════════════════════════════════════
     SERVICES — alternating image/text rows
══════════════════════════════════════ --}}
<section class="font-body py-20 md:py-28" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl space-y-6">

        {{-- 1 — Foreign Investment --}}
        <div class="service-card reveal reveal-delay-1">
            <div class="service-card-image">
                <img src="{{ asset('images/investor/inv.webp') }}" alt="Foreign Investment">
            </div>
            <div class="service-card-body">
                <span class="service-num">01</span>
                <div class="card-rule"></div>
                <h3 class="font-display text-2xl md:text-3xl font-bold mb-4" style="color: var(--forest);">
                    Foreign Investment
                </h3>
                <p class="text-base leading-relaxed" style="color: var(--muted);">
                    We provide cutting-edge technology insights and digital transformation support to help investors navigate Japan's advanced tech landscape. Our services include technology transfer facilitation and access to Japan's leading innovation hubs.
                </p>
                <a href="{{ url('/contact') }}"
                   class="mt-8 inline-flex items-center gap-2 text-sm font-semibold tracking-wide transition-colors"
                   style="color: var(--jade);"
                   onmouseover="this.style.color='var(--forest)'" onmouseout="this.style.color='var(--jade)'">
                    Enquire about this service
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- 2 — Economic Growth (reversed) --}}
        <div class="service-card reverse reveal reveal-delay-2">
            <div class="service-card-image">
                <img src="{{ asset('images/investor/inv2.webp') }}" alt="Economic Growth and Development">
            </div>
            <div class="service-card-body">
                <span class="service-num">02</span>
                <div class="card-rule"></div>
                <h3 class="font-display text-2xl md:text-3xl font-bold mb-4" style="color: var(--forest);">
                    Economic Growth &amp; Development
                </h3>
                <p class="text-base leading-relaxed" style="color: var(--muted);">
                    Our economic development services focus on identifying high-growth sectors and emerging market opportunities between Nigeria and Japan. We deliver comprehensive market analysis and strategic sector development support.
                </p>
                <a href="{{ url('/contact') }}"
                   class="mt-8 inline-flex items-center gap-2 text-sm font-semibold tracking-wide transition-colors"
                   style="color: var(--jade);"
                   onmouseover="this.style.color='var(--forest)'" onmouseout="this.style.color='var(--jade)'">
                    Enquire about this service
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- 3 — SMEs Support --}}
        <div class="service-card reveal reveal-delay-3">
            <div class="service-card-image">
                <img src="{{ asset('images/investor/inv3.jpeg') }}" alt="SMEs Support">
            </div>
            <div class="service-card-body">
                <span class="service-num">03</span>
                <div class="card-rule"></div>
                <h3 class="font-display text-2xl md:text-3xl font-bold mb-4" style="color: var(--forest);">
                    SMEs Support
                </h3>
                <p class="text-base leading-relaxed" style="color: var(--muted);">
                    We specialise in supporting small and medium enterprises with tailored investment solutions and business development programmes. Our SME services include capacity building, access to Japanese technology, and connection to funding opportunities.
                </p>
                <a href="{{ url('/contact') }}"
                   class="mt-8 inline-flex items-center gap-2 text-sm font-semibold tracking-wide transition-colors"
                   style="color: var(--jade);"
                   onmouseover="this.style.color='var(--forest)'" onmouseout="this.style.color='var(--jade)'">
                    Enquire about this service
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- 4 — Technology (reversed) --}}
        <div class="service-card reverse reveal reveal-delay-4">
            <div class="service-card-image">
                <img src="{{ asset('images/investor/inv4.jpeg') }}" alt="Technology and Internet Knowledge">
            </div>
            <div class="service-card-body">
                <span class="service-num">04</span>
                <div class="card-rule"></div>
                <h3 class="font-display text-2xl md:text-3xl font-bold mb-4" style="color: var(--forest);">
                    Technology &amp; Internet Knowledge
                </h3>
                <p class="text-base leading-relaxed" style="color: var(--muted);">
                    We provide cutting-edge technology insights and digital transformation support to help investors navigate Japan's advanced tech landscape. Our services include technology transfer facilitation and access to Japan's leading innovation hubs.
                </p>
                <a href="{{ url('/contact') }}"
                   class="mt-8 inline-flex items-center gap-2 text-sm font-semibold tracking-wide transition-colors"
                   style="color: var(--jade);"
                   onmouseover="this.style.color='var(--forest)'" onmouseout="this.style.color='var(--jade)'">
                    Enquire about this service
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

    </div>
</section>

{{-- ══════════════════════════════════════
     CTA STRIP
══════════════════════════════════════ --}}
<section class="font-body py-20 md:py-24 bg-white" style="border-top: 1px solid var(--border);">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center reveal">

        <h2 class="font-display text-3xl md:text-4xl font-bold mb-4" style="color: var(--forest);">
            Ready to Begin Your Nigeria&#8209;Japan Journey?
        </h2>
        <p class="text-base mb-10 max-w-xl mx-auto" style="color: var(--muted);">
            Our team is on hand to guide you through every step — from first enquiry to lasting partnership.
        </p>

        <a href="{{ url('/contact') }}"
           class="inline-flex items-center gap-3 font-semibold text-sm tracking-[.08em] uppercase px-10 py-4 transition-all duration-300 hover:opacity-90"
           style="background: var(--forest); color: #fff;">
            Contact Us Today
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
});
</script>
@endpush

@endsection