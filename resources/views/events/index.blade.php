@extends('layouts.app')
@include('layouts.navigation')

@section('title', 'Events | Nigeria-Japan Chamber of Commerce')

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

    /* Hero */
    .events-hero {
        background: var(--forest);
        position: relative; overflow: hidden;
    }
    .events-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Event card */
    .event-card {
        background: #fff;
        border: 1px solid var(--border);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: border-color .3s, transform .3s;
    }
    .event-card:hover {
        border-color: var(--sage);
        transform: translateY(-3px);
    }

    .event-card-image {
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #dce8e1;
        position: relative;
    }
    .event-card-image img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
        display: block;
    }
    .event-card:hover .event-card-image img { transform: scale(1.04); }

  
    .date-badge {
        position: absolute;
        top: 14px; left: 14px;
        background: var(--forest);
        color: #fff;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        width: 52px;
        padding: 8px 0;
        z-index: 2;
    }
    .date-badge .day {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1;
    }
    .date-badge .month {
        font-family: 'DM Sans', sans-serif;
        font-size: .55rem;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-top: 2px;
        opacity: .8;
    }

    .event-card-body {
        padding: 1.5rem 1.75rem 1.75rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .event-meta {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .72rem;
        font-weight: 500;
        letter-spacing: .06em;
        text-transform: uppercase;
        margin-bottom: .75rem;
    }


    .img-placeholder {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        background: #dce8e1;
    }


    .event-card-featured {
        display: grid;
        grid-template-columns: 1fr;
        background: #fff;
        border: 1px solid var(--border);
        overflow: hidden;
        transition: border-color .3s;
        margin-bottom: 2.5rem;
    }
    .event-card-featured:hover { border-color: var(--sage); }
    @media (min-width: 768px) {
        .event-card-featured { grid-template-columns: 1fr 1fr; }
        .event-card-featured .event-card-image { aspect-ratio: unset; min-height: 360px; }
    }
    .event-card-featured .event-card-image img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform .5s ease;
        display: block;
    }
    .event-card-featured:hover .event-card-image img { transform: scale(1.03); }
    .event-card-featured .event-card-body {
        padding: 2.5rem 3rem;
        display: flex; flex-direction: column; justify-content: center;
    }
</style>
@endonce


<section class="events-hero font-body py-24 md:py-32">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center relative z-10">

        <span class="text-xs font-semibold tracking-[.2em] uppercase mb-5 block" style="color: var(--sage);">
            What's On
        </span>

        <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight text-white">
            Chamber Events
        </h1>

        <p class="text-base md:text-lg leading-relaxed max-w-xl mx-auto" style="color: rgba(255,255,255,.6);">
            Trade delegations, networking forums, expo participations, and bilateral summits — stay connected with the moments that matter.
        </p>

    </div>
</section>

<section class="font-body py-20 md:py-28" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-7xl">

        @forelse($events as $event)

            @php
                $mediaUrl   = $event->getFirstMediaUrl('event_images');
                $hasImage   = !empty($mediaUrl);
                $dateObj    = $event->event_date;
                $dayNum     = $dateObj ? $dateObj->format('d') : null;
                $monthShort = $dateObj ? $dateObj->format('M') : null;
                $dateFull   = $dateObj ? $dateObj->format('F d, Y') : 'Date TBD';
            @endphp

            {{-- Featured layout for first event --}}
            @if($loop->first)

            <div class="event-card-featured reveal">

                <div class="event-card-image relative">
                    @if($hasImage)
                        <img src="{{ $mediaUrl }}" alt="{{ $event->title }}">
                    @else
                        <div class="img-placeholder" style="min-height: 300px;">
                            <svg class="w-12 h-12" fill="none" stroke="#a0b8a5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    @if($dayNum)
                    <div class="date-badge">
                        <span class="day">{{ $dayNum }}</span>
                        <span class="month">{{ $monthShort }}</span>
                    </div>
                    @endif
                </div>

                <div class="event-card-body">
                    <span class="text-xs font-semibold tracking-[.15em] uppercase mb-4 block" style="color: var(--sage);">
                        Featured Event
                    </span>
                    <h2 class="font-display text-3xl md:text-4xl font-bold mb-4 leading-snug" style="color: var(--forest);">
                        {{ $event->title }}
                    </h2>
                    <div class="event-meta mb-5" style="color: var(--sage);">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $dateFull }}
                        @if($event->location)
                            <span style="color: var(--border);">·</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $event->location }}
                        @endif
                    </div>
                    <a href="{{ url('/events/'.$event->slug) }}"
                       class="mt-auto inline-flex items-center gap-3 font-semibold text-sm tracking-[.08em] uppercase px-8 py-4 self-start transition-all duration-300 hover:opacity-90"
                       style="background: var(--forest); color: #fff;">
                        View Event
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

            </div>

            @if(!$loop->last)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @endif

            @elseif($loop->last && $loop->count > 1)

                {{-- last card in grid --}}
                <div class="event-card reveal reveal-delay-{{ (($loop->index - 1) % 3) + 1 }}">
                    <div class="event-card-image relative">
                        @if($hasImage)
                            <img src="{{ $mediaUrl }}" alt="{{ $event->title }}">
                        @else
                            <div class="img-placeholder">
                                <svg class="w-10 h-10" fill="none" stroke="#a0b8a5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        @if($dayNum)
                        <div class="date-badge">
                            <span class="day">{{ $dayNum }}</span>
                            <span class="month">{{ $monthShort }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="event-card-body">
                        <div class="event-meta" style="color: var(--sage);">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $dateFull }}
                        </div>
                        @if($event->location)
                        <div class="event-meta -mt-1" style="color: var(--muted);">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $event->location }}
                        </div>
                        @endif
                        <h3 class="font-display text-xl font-bold mb-4 leading-snug line-clamp-2 mt-2" style="color: var(--forest);">
                            {{ $event->title }}
                        </h3>
                        <a href="{{ url('/events/'.$event->slug) }}"
                           class="mt-auto inline-flex items-center gap-2 text-sm font-semibold transition-colors"
                           style="color: var(--jade);"
                           onmouseover="this.style.color='var(--forest)'" onmouseout="this.style.color='var(--jade)'">
                            View Event
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            @else

    
                <div class="event-card reveal reveal-delay-{{ (($loop->index - 1) % 3) + 1 }}">
                    <div class="event-card-image relative">
                        @if($hasImage)
                            <img src="{{ $mediaUrl }}" alt="{{ $event->title }}">
                        @else
                            <div class="img-placeholder">
                                <svg class="w-10 h-10" fill="none" stroke="#a0b8a5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        @if($dayNum)
                        <div class="date-badge">
                            <span class="day">{{ $dayNum }}</span>
                            <span class="month">{{ $monthShort }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="event-card-body">
                        <div class="event-meta" style="color: var(--sage);">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $dateFull }}
                        </div>
                        @if($event->location)
                        <div class="event-meta -mt-1" style="color: var(--muted);">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $event->location }}
                        </div>
                        @endif
                        <h3 class="font-display text-xl font-bold mb-4 leading-snug line-clamp-2 mt-2" style="color: var(--forest);">
                            {{ $event->title }}
                        </h3>
                        <a href="{{ url('/events/'.$event->slug) }}"
                           class="mt-auto inline-flex items-center gap-2 text-sm font-semibold transition-colors"
                           style="color: var(--jade);"
                           onmouseover="this.style.color='var(--forest)'" onmouseout="this.style.color='var(--jade)'">
                            View Event
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                @if($loop->last)
                </div>{{-- close grid --}}
                @endif

            @endif

        @empty
            <div class="text-center py-24 reveal">
                <div class="mx-auto w-16 h-16 mb-6 flex items-center justify-center" style="background: #e8f2ec;">
                    <svg class="w-8 h-8" fill="none" stroke="#74a98a" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="font-display text-2xl font-bold mb-2" style="color: var(--forest);">No events scheduled</p>
                <p class="text-sm" style="color: var(--muted);">Check back soon — upcoming events will appear here.</p>
            </div>
        @endforelse


        @if($events->hasPages())
        <div class="mt-14 flex justify-center reveal">
            {{ $events->links() }}
        </div>
        @endif

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