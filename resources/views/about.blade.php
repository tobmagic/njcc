@extends('layouts.app')
@include('layouts.navigation') 

@section('title', 'About Us | Nigeria-Japan Chamber of Commerce')

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
        --ink:    #1c1c1c;
        --muted:  #5a5a5a;
        --border: #e2ddd6;
    }
    .font-display { font-family: 'Playfair Display', Georgia, serif; }
    .font-body    { font-family: 'DM Sans', sans-serif; }

    .rule-diamond {
        display: flex; align-items: center; gap: 12px; width: fit-content;
    }
    .rule-diamond::before, .rule-diamond::after {
        content: ''; display: block; width: 48px; height: 1px; background: var(--sage);
    }
    .rule-diamond span { display: block; width: 7px; height: 7px; background: var(--jade); transform: rotate(45deg); }

    /* Reveal */
    .reveal { opacity: 0; transform: translateY(20px); transition: opacity .65s ease, transform .65s ease; }
    .reveal.visible { opacity: 1; transform: none; }
    .reveal-delay-1 { transition-delay: .1s; }
    .reveal-delay-2 { transition-delay: .2s; }
    .reveal-delay-3 { transition-delay: .3s; }

    /* Hero banner */
    .about-hero {
        background: var(--forest);
        position: relative; overflow: hidden;
    }
    .about-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Portrait frame */
    .portrait-frame {
        position: relative;
    }
    .portrait-frame::before {
        content: '';
        position: absolute;
        top: -10px; left: -10px;
        width: 100%; height: 100%;
        border: 1px solid var(--sage);
        opacity: 0.4;
        pointer-events: none;
        z-index: 0;
    }
    .portrait-frame img,
    .portrait-frame .portrait-placeholder {
        position: relative;
        z-index: 1;
    }
    .portrait-placeholder {
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 12px;
        background: #e8ede9;
        width: 100%;
        aspect-ratio: 3/4;
        max-height: 420px;
    }
    .portrait-placeholder svg { color: #a0b8a5; }
    .portrait-placeholder span { font-size: .75rem; letter-spacing: .1em; text-transform: uppercase; color: #8aaa90; }

    /* Stats bar */
    .stat-item { text-align: center; padding: 0 2rem; }
    .stat-item + .stat-item { border-left: 1px solid var(--border); }

    /* Section label pill */
    .section-eyebrow {
        display: inline-block;
        font-size: .65rem;
        font-weight: 600;
        letter-spacing: .2em;
        text-transform: uppercase;
        color: var(--sage);
        margin-bottom: 1.25rem;
    }

    /* Quote pull */
    .pull-quote {
        border-left: 3px solid var(--jade);
        padding-left: 1.5rem;
        font-family: 'Playfair Display', serif;
        font-style: italic;
        color: var(--forest);
        font-size: 1.25rem;
        line-height: 1.5;
    }
    @media (min-width: 768px) { .pull-quote { font-size: 1.45rem; } }
</style>
@endonce

{{-- ══════════════════════════════════════
     HERO BANNER
══════════════════════════════════════ --}}
<section class="about-hero font-body py-24 md:py-32">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center relative z-10">

        <span class="section-eyebrow" style="color: var(--sage);">Established 1995</span>

        <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight text-white">
            About Us
        </h1>

        <p class="text-base md:text-lg leading-relaxed max-w-2xl mx-auto mb-0" style="color: rgba(255,255,255,.65);">
            Nearly three decades of building enduring bridges between<br class="hidden md:block"> Nigeria and Japan — two nations, one vision.
        </p>

    </div>
</section>

{{-- ══════════════════════════════════════
     STATS BAR
══════════════════════════════════════ --}}
<section class="font-body bg-white border-b" style="border-color: var(--border);">
    <div class="container mx-auto px-6 lg:px-8 max-w-5xl">
        <div class="flex flex-wrap justify-center md:justify-between py-10 gap-8 md:gap-0">

            <div class="stat-item reveal">
                <p class="font-display text-4xl md:text-5xl font-bold" style="color: var(--forest);">1995</p>
                <p class="text-xs tracking-widest uppercase mt-1" style="color: var(--muted);">Founded</p>
            </div>
            <div class="stat-item reveal reveal-delay-1">
                <p class="font-display text-4xl md:text-5xl font-bold" style="color: var(--forest);">29+</p>
                <p class="text-xs tracking-widest uppercase mt-1" style="color: var(--muted);">Years Active</p>
            </div>
            <div class="stat-item reveal reveal-delay-2">
                <p class="font-display text-4xl md:text-5xl font-bold" style="color: var(--forest);">$10B</p>
                <p class="text-xs tracking-widest uppercase mt-1" style="color: var(--muted);">Bilateral Trade</p>
            </div>
            <div class="stat-item reveal reveal-delay-3">
                <p class="font-display text-4xl md:text-5xl font-bold" style="color: var(--forest);">51</p>
                <p class="text-xs tracking-widest uppercase mt-1" style="color: var(--muted);">Japanese Firms in Nigeria</p>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     INTRO PARAGRAPH
══════════════════════════════════════ --}}
<section class="font-body py-24 md:py-32" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center">

        <div class="rule-diamond reveal mx-auto mb-8"><span></span></div>

        <h2 class="font-display reveal reveal-delay-1 text-3xl md:text-4xl lg:text-5xl font-bold mb-8 leading-snug" style="color: var(--forest);">
            Connecting Businesses.<br>Creating Opportunities.<br>Driving Growth.
        </h2>

        <p class="reveal reveal-delay-2 text-base md:text-lg leading-relaxed max-w-3xl mx-auto" style="color: var(--muted);">
            The Nigeria-Japan Chamber of Commerce was born from passion and vision in 1995, founded with an unwavering commitment to promote and expand trade between Nigeria and Japan. Inspired by Japan's iconic business excellence and driven by the belief that both nations could achieve remarkable prosperity through strategic partnerships, we embarked on a journey to bridge two dynamic economies across continents.
        </p>

    </div>
</section>

{{-- ══════════════════════════════════════
     WORD FROM THE PRESIDENT
══════════════════════════════════════ --}}
<section class="font-body py-24 md:py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-14 lg:gap-20 items-start">

            {{-- Portrait --}}
            <div class="lg:col-span-4 reveal">
                <div class="portrait-frame">
                    <img src="{{ asset('images/president.jpg') }}"
                         alt="Mandeking E. Ijoma — President"
                         class="w-full object-cover object-top"
                         style="aspect-ratio: 3/4; max-height: 420px;">
                </div>
                <div class="mt-5 pl-1">
                    <p class="font-display text-lg font-semibold" style="color: var(--forest);">Mandeking E. Ijoma</p>
                    <p class="text-xs tracking-widest uppercase mt-1" style="color: var(--sage);">President</p>
                </div>
            </div>

            {{-- Text --}}
            <div class="lg:col-span-8 pt-1">
                <span class="section-eyebrow reveal">Word from the President</span>
                <div class="rule-diamond reveal reveal-delay-1 mb-6"><span></span></div>

                <h2 class="font-display reveal reveal-delay-1 text-4xl md:text-5xl font-bold mb-8 leading-tight" style="color: var(--forest);">
                    Mandeking E. Ijoma
                </h2>

                <div class="reveal reveal-delay-2 space-y-5 text-base md:text-[1.05rem] leading-relaxed" style="color: var(--muted);">
                    <p>
                        In 1995, inspired by Japan's culture of business excellence and precision, I founded the Chamber with a singular vision: to build an enduring bridge between Nigeria and Japan — two nations with complementary strengths and enormous untapped potential.
                    </p>
                    <p>
                        Despite past economic challenges in Nigeria, the Chamber is revitalized, buoyed by Nigeria's $20 billion in diaspora remittances and positive endorsements from the IMF and World Bank. With renewed partnerships and 2025 initiatives including business delegations and Osaka Expo participation, the opportunity before us is historic.
                    </p>
                    <p>
                        The Chamber invites all forward-thinking businesses to join this transformative moment. The window of opportunity is open — and the time to act is now.
                    </p>
                </div>

                <blockquote class="pull-quote reveal reveal-delay-3 mt-10">
                    "Join us. Let's build the future of Nigeria-Japan trade — together."
                </blockquote>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     WORD FROM THE EXECUTIVE SECRETARY
══════════════════════════════════════ --}}
<section class="font-body py-24 md:py-32" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-14 lg:gap-20 items-start">

            {{-- Text (left) --}}
            <div class="lg:col-span-8 pt-1 order-2 lg:order-1">
                <span class="section-eyebrow reveal">Word from the Executive Secretary</span>
                <div class="rule-diamond reveal reveal-delay-1 mb-6"><span></span></div>

                <h2 class="font-display reveal reveal-delay-1 text-4xl md:text-5xl font-bold mb-8 leading-tight" style="color: var(--forest);">
                    Dr. Jude E. Mbonu
                </h2>

                <div class="reveal reveal-delay-2 space-y-5 text-base md:text-[1.05rem] leading-relaxed" style="color: var(--muted);">
                    <p>
                        The Nigeria-Japan Chamber of Commerce, established in 1995, welcomes members, partners, and the broader business community to its revitalised platform. After a period of reduced activity resulting from Nigeria's economic headwinds since 2015, the Chamber is reinvigorating itself under the Tinubu administration's reforms — a shift that has already yielded a historic $20 billion in diaspora remittances and renewed confidence from the IMF and World Bank.
                    </p>
                    <p>
                        Bilateral trade between Nigeria and Japan stands at $10 billion today, with 51 Japanese firms operating in Nigeria. Our ambition is to grow that figure substantially — and to establish a meaningful Nigerian business presence in Japan in return.
                    </p>
                    <p>
                        Drawing on my prior experience at the Japanese Embassy, I am committed to enhancing bilateral trade at every level, keeping our members informed, and ensuring the Chamber operates with the precision and professionalism our mandate demands.
                    </p>
                </div>

                <blockquote class="pull-quote reveal reveal-delay-3 mt-10">
                    "The foundations are in place. The partnerships are ready. The next chapter begins now."
                </blockquote>
            </div>

            {{-- Portrait (right) --}}
            <div class="lg:col-span-4 order-1 lg:order-2 reveal">
                <div class="portrait-frame">
                    {{-- Replace src with: {{ asset('images/secretary.jpg') }} when available --}}
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                         alt="Dr. Jude E. Mbonu — Executive Secretary"
                         class="w-full object-cover object-top"
                         style="aspect-ratio: 3/4; max-height: 420px;">
                </div>
                <div class="mt-5 pl-1">
                    <p class="font-display text-lg font-semibold" style="color: var(--forest);">Dr. Jude E. Mbonu</p>
                    <p class="text-xs tracking-widest uppercase mt-1" style="color: var(--sage);">Executive Secretary</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     HERITAGE BLOCK
══════════════════════════════════════ --}}
<section class="font-body py-24 md:py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-5xl">

        <div class="text-center mb-16">
            <span class="section-eyebrow reveal">Our Heritage</span>
            <div class="rule-diamond reveal reveal-delay-1 mx-auto mb-8"><span></span></div>
            <h2 class="font-display reveal reveal-delay-1 text-4xl md:text-5xl font-bold leading-tight" style="color: var(--forest);">
                Incorporated Since Day One
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-px reveal reveal-delay-2" style="background: var(--border);">

            <div class="bg-white px-8 py-10">
                <p class="font-display text-3xl font-bold mb-3" style="color: var(--forest);">Founded</p>
                <p class="text-sm leading-relaxed" style="color: var(--muted);">
                    Established in 1995 with a mission to promote and expand trade between Nigeria and Japan, making us one of Nigeria's oldest bilateral chambers.
                </p>
            </div>

            <div class="bg-white px-8 py-10" style="border-left: 1px solid var(--border);">
                <p class="font-display text-3xl font-bold mb-3" style="color: var(--forest);">Weathered</p>
                <p class="text-sm leading-relaxed" style="color: var(--muted);">
                    Through Nigeria's economic cycles and global market shifts, we maintained the Chamber's structure and institutional knowledge intact.
                </p>
            </div>

            <div class="bg-white px-8 py-10" style="border-left: 1px solid var(--border);">
                <p class="font-display text-3xl font-bold mb-3" style="color: var(--forest);">Revitalised</p>
                <p class="text-sm leading-relaxed" style="color: var(--muted);">
                    Emerging stronger with renewed leadership, 2025 initiatives, and a clear vision to capitalise on the extraordinary bilateral opportunity now before both nations.
                </p>
            </div>

        </div>

    </div>
</section>

{{-- ══════════════════════════════════════
     VISION & MISSION COMPONENT
══════════════════════════════════════ --}}
<x-home.vision-mission />

{{-- ══════════════════════════════════════
     LEADERSHIP OVERVIEW
══════════════════════════════════════ --}}
<section class="font-body py-24 md:py-32" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-5xl text-center">

        <span class="section-eyebrow reveal">Our Leadership</span>
        <div class="rule-diamond reveal reveal-delay-1 mx-auto mb-8"><span></span></div>

        <h2 class="font-display reveal reveal-delay-1 text-4xl md:text-5xl font-bold mb-8 leading-tight" style="color: var(--forest);">
            Guiding Nigeria-Japan Trade<br>into the Future
        </h2>

        <p class="reveal reveal-delay-2 text-base md:text-lg leading-relaxed mx-auto max-w-3xl mb-6" style="color: var(--muted);">
            Our leadership team combines decades of international business experience with deep cultural understanding of both Nigerian and Japanese markets — bringing both historical perspective and forward-thinking innovation to every initiative.
        </p>

        <p class="reveal reveal-delay-3 text-base md:text-lg leading-relaxed mx-auto max-w-3xl mb-12" style="color: var(--muted);">
            Our commitment to member success, combined with a strategic approach to bilateral trade development, positions us uniquely to guide businesses through the complexities of international commerce while maximising opportunities in both markets.
        </p>

        <div class="reveal reveal-delay-3">
            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-3 font-semibold text-sm tracking-[.08em] uppercase px-10 py-4 transition-all duration-300 hover:opacity-90"
               style="background: var(--forest); color: #fff;">
                Get In Touch
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
});
</script>
@endpush

@endsection