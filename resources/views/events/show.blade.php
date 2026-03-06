@extends('layouts.app')
@include('layouts.navigation')

@section('title', $event->title . ' | Nigeria-Japan Chamber of Commerce')

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
    .event-hero {
        background: var(--forest);
        position: relative; overflow: hidden;
    }
    .event-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Reading progress */
    #reading-progress {
        position: fixed; top: 0; left: 0;
        height: 2px; width: 0%;
        background: var(--jade);
        z-index: 999;
        transition: width .1s linear;
    }

    /* Article body */
    .event-body {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.05rem;
        line-height: 1.85;
        color: #3d3d3d;
    }
    .event-body h2 { font-family:'Playfair Display',serif; font-size:1.75rem; font-weight:700; color:var(--forest); margin:2.5rem 0 1rem; }
    .event-body h3 { font-family:'Playfair Display',serif; font-size:1.3rem; font-weight:600; color:var(--jade); margin:2rem 0 .75rem; }
    .event-body p  { margin-bottom:1.4rem; }
    .event-body a  { color:var(--jade); text-decoration:underline; text-underline-offset:3px; }
    .event-body ul, .event-body ol { padding-left:1.5rem; margin-bottom:1.4rem; }
    .event-body ul { list-style:disc; }
    .event-body ol { list-style:decimal; }
    .event-body li { margin-bottom:.4rem; }
    .event-body blockquote {
        border-left:3px solid var(--jade); padding:.75rem 1.5rem;
        margin:2rem 0; background:#f3f7f4;
        font-family:'Playfair Display',serif; font-style:italic;
        font-size:1.15rem; color:var(--forest);
    }
    .event-body strong { color:#1c1c1c; }
    .event-body hr { border:none; border-top:1px solid var(--border); margin:2.5rem 0; }

    /* ── Gallery ── */
    .gallery-grid {
        columns: 2;
        column-gap: 8px;
    }
    @media (min-width: 640px)  { .gallery-grid { columns: 3; } }
    @media (min-width: 1024px) { .gallery-grid { columns: 4; } }

    .gallery-item {
        break-inside: avoid;
        margin-bottom: 8px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        background: #dce8e1;
        display: block;
    }
    .gallery-item img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform .5s ease, filter .4s ease;
    }
    .gallery-item:hover img {
        transform: scale(1.06);
        filter: brightness(.85);
    }

    .gallery-item::after {
        content: '';
        position: absolute; inset: 0;
        background: rgba(26,66,40,0);
        transition: background .3s;
        display: flex; align-items: center; justify-content: center;
    }
    .gallery-item:hover::after {
        background: rgba(26,66,40,.25);
    }

    .gallery-item .expand-icon {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%) scale(.6);
        opacity: 0;
        transition: opacity .3s, transform .3s;
        z-index: 2;
        color: #fff;
        pointer-events: none;
    }
    .gallery-item:hover .expand-icon {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }


    #lightbox {
        display: none;
        position: fixed; inset: 0;
        background: rgba(0,0,0,.95);
        z-index: 1000;
        align-items: center; justify-content: center;
        flex-direction: column;
    }
    #lightbox.open { display: flex; }

    #lightbox-img {
        max-width: 90vw;
        max-height: 82vh;
        object-fit: contain;
        display: block;
        transition: opacity .25s ease;
    }

    #lightbox-counter {
        font-family: 'DM Sans', sans-serif;
        font-size: .75rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: rgba(255,255,255,.4);
        margin-top: 16px;
    }

    .lb-btn {
        position: absolute; top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,.08);
        border: none; color: #fff;
        width: 48px; height: 48px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: background .2s;
    }
    .lb-btn:hover { background: rgba(255,255,255,.18); }
    #lb-prev { left: 16px; }
    #lb-next { right: 16px; }

    #lb-close {
        position: absolute; top: 18px; right: 22px;
        background: none; border: none;
        color: rgba(255,255,255,.5); font-size: 1.6rem;
        cursor: pointer; line-height: 1;
        transition: color .2s;
    }
    #lb-close:hover { color: #fff; }

    /* Back link */
    .back-link {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: .72rem; font-weight: 600;
        letter-spacing: .12em; text-transform: uppercase;
        color: rgba(255,255,255,.5);
        transition: color .2s;
        text-decoration: none;
    }
    .back-link:hover { color: #fff; }

    /* Meta pill */
    .meta-item {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: .72rem; font-weight: 500;
        letter-spacing: .08em; text-transform: uppercase;
    }
</style>
@endonce

<div id="reading-progress"></div>


<section class="event-hero font-body pt-16 pb-20 md:pt-20 md:pb-28">
    <div class="container mx-auto px-6 lg:px-8 max-w-3xl text-center relative z-10">

        <a href="{{ url('/events') }}" class="back-link mb-8 mx-auto justify-center inline-flex">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            All Events
        </a>

        <p class="text-xs font-semibold tracking-[.2em] uppercase mt-6 mb-5 block" style="color: var(--sage);">
            Chamber Event
        </p>

        <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-bold leading-tight text-white mb-8">
            {{ $event->title }}
        </h1>

        <div class="flex flex-wrap items-center justify-center gap-5">
            @if($event->event_date)
            <span class="meta-item" style="color: rgba(255,255,255,.55);">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $event->event_date->format('F d, Y') }}
            </span>
            @endif
            @if($event->location)
            <span class="meta-item" style="color: rgba(255,255,255,.55);">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $event->location }}
            </span>
            @endif
        </div>

    </div>
</section>

@php $heroMedia = $event->getMedia('event_images')->first(); @endphp
@if($heroMedia)
<div class="font-body bg-white">
    <div class="container mx-auto px-0 md:px-6 lg:px-8 max-w-5xl">
        <div class="-mt-10 md:-mt-16 relative z-10 overflow-hidden reveal" style="max-height: 55vh;">
            <img src="{{ $heroMedia->getUrl() }}"
                 alt="{{ $event->title }}"
                 class="w-full object-contain object-center"
                 style="max-height: 55vh;">
        </div>
    </div>
</div>
@endif


<section class="font-body py-16 md:py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-3xl">
        <div class="event-body reveal">
            {!! $event->description !!}
        </div>
    </div>
</section>


@php $allImages = $event->getMedia('event_images'); @endphp
@if($allImages->count() > 0)
<section class="font-body py-16 md:py-24" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-7xl">

        <div class="text-center mb-12 reveal">
            <p class="text-xs font-semibold tracking-[.2em] uppercase mb-3" style="color: var(--sage);">Visual Record</p>
            <h2 class="font-display text-3xl md:text-4xl font-bold" style="color: var(--forest);">
                Event Gallery
                <span class="font-body text-base font-normal ml-2" style="color: var(--muted);">({{ $allImages->count() }} photos)</span>
            </h2>
        </div>

        <div class="gallery-grid reveal reveal-delay-1">
            @foreach($allImages as $i => $media)
                <div class="gallery-item" data-index="{{ $i }}" onclick="openLightbox({{ $i }})">
                    <img src="{{ $media->getUrl() }}"
                         alt="Event photo {{ $i + 1 }}"
                         loading="{{ $i < 6 ? 'eager' : 'lazy' }}">
                    <svg class="expand-icon w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ── Lightbox ── --}}
<div id="lightbox" onclick="handleLightboxClick(event)">
    <button id="lb-close" onclick="closeLightbox()">&times;</button>
    <button class="lb-btn" id="lb-prev" onclick="shiftLightbox(-1)">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <img id="lightbox-img" src="" alt="">
    <button class="lb-btn" id="lb-next" onclick="shiftLightbox(1)">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
    <p id="lightbox-counter"></p>
</div>

@php
    $imageUrls = $allImages->map(fn($m) => $m->getUrl())->toJson();
@endphp
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    /* Reveal */
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

    /* Reading progress */
    const bar  = document.getElementById('reading-progress');
    const body = document.querySelector('.event-body');
    if (bar && body) {
        window.addEventListener('scroll', () => {
            const rect    = body.getBoundingClientRect();
            const total   = body.offsetHeight - window.innerHeight;
            const scrolled = Math.max(0, -rect.top);
            bar.style.width = Math.min(100, (scrolled / total) * 100) + '%';
        }, { passive: true });
    }
});

/* ── Lightbox ── */
const images  = {!! isset($imageUrls) ? $imageUrls : '[]' !!};
let   current = 0;
const lb      = document.getElementById('lightbox');
const lbImg   = document.getElementById('lightbox-img');
const lbCount = document.getElementById('lightbox-counter');

function openLightbox(idx) {
    if (!lb) return;
    current = idx;
    updateLightbox();
    lb.classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    if (!lb) return;
    lb.classList.remove('open');
    document.body.style.overflow = '';
}
function shiftLightbox(dir) {
    current = (current + dir + images.length) % images.length;
    updateLightbox();
}
function updateLightbox() {
    lbImg.style.opacity = '0';
    setTimeout(() => {
        lbImg.src = images[current];
        lbImg.style.opacity = '1';
    }, 150);
    if (lbCount) lbCount.textContent = (current + 1) + ' / ' + images.length;
}
function handleLightboxClick(e) {
    if (e.target === lb) closeLightbox();
}
document.addEventListener('keydown', e => {
    if (!lb?.classList.contains('open')) return;
    if (e.key === 'ArrowRight') shiftLightbox(1);
    if (e.key === 'ArrowLeft')  shiftLightbox(-1);
    if (e.key === 'Escape')     closeLightbox();
});
</script>
@endpush

@endsection