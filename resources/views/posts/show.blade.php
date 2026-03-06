@extends('layouts.app')
@include('layouts.navigation')

@section('title', $post->title . ' | Nigeria-Japan Chamber of Commerce')

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

    /* ── Article hero ── */
    .post-hero {
        background: var(--forest);
        position: relative; overflow: hidden;
    }
    .post-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* ── Article body prose ── */
    .article-body {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.05rem;
        line-height: 1.85;
        color: #3d3d3d;
    }
    .article-body h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--forest);
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        line-height: 1.25;
    }
    .article-body h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--jade);
        margin-top: 2rem;
        margin-bottom: .75rem;
    }
    .article-body p { margin-bottom: 1.4rem; }
    .article-body a { color: var(--jade); text-decoration: underline; text-underline-offset: 3px; }
    .article-body a:hover { color: var(--forest); }
    .article-body ul, .article-body ol {
        padding-left: 1.5rem;
        margin-bottom: 1.4rem;
    }
    .article-body ul { list-style: disc; }
    .article-body ol { list-style: decimal; }
    .article-body li { margin-bottom: .4rem; }
    .article-body blockquote {
        border-left: 3px solid var(--jade);
        padding: .75rem 1.5rem;
        margin: 2rem 0;
        background: #f3f7f4;
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-size: 1.15rem;
        color: var(--forest);
    }
    .article-body img {
        width: 100%;
        height: auto;
        margin: 2rem 0;
    }
    .article-body strong { color: var(--ink); }
    .article-body hr {
        border: none;
        border-top: 1px solid var(--border);
        margin: 2.5rem 0;
    }

    /* ── Gallery ── */
    .gallery-item {
        overflow: hidden;
        background: #edeae4;
        cursor: pointer;
    }
    .gallery-item img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .gallery-item:hover img { transform: scale(1.05); }

    /* ── Lightbox ── */
    #lightbox {
        display: none;
        position: fixed; inset: 0;
        background: rgba(0,0,0,.92);
        z-index: 1000;
        align-items: center; justify-content: center;
    }
    #lightbox.open { display: flex; }
    #lightbox img { max-width: 90vw; max-height: 90vh; object-fit: contain; }
    #lightbox-close {
        position: absolute; top: 20px; right: 24px;
        color: rgba(255,255,255,.7); font-size: 2rem; cursor: pointer;
        line-height: 1; background: none; border: none;
    }

    /* ── Related cards ── */
    .related-card {
        background: #fff;
        border: 1px solid var(--border);
        overflow: hidden;
        transition: border-color .3s, box-shadow .3s, transform .3s;
    }
    .related-card:hover {
        border-color: var(--sage);
        box-shadow: 0 6px 24px rgba(26,66,40,.07);
        transform: translateY(-3px);
    }
    .related-card-image {
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #dce8e1;
    }
    .related-card-image img { width:100%; height:100%; object-fit:cover; transition: transform .4s ease; }
    .related-card:hover .related-card-image img { transform: scale(1.04); }

    /* ── Back link ── */
    .back-link {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: .75rem; font-weight: 600;
        letter-spacing: .12em; text-transform: uppercase;
        color: rgba(255,255,255,.55);
        transition: color .2s;
    }
    .back-link:hover { color: #fff; }

    /* ── Reading progress bar ── */
    #reading-progress {
        position: fixed; top: 0; left: 0;
        height: 2px; width: 0%;
        background: var(--jade);
        z-index: 999;
        transition: width .1s linear;
    }
</style>
@endonce

{{-- Reading progress --}}
<div id="reading-progress"></div>

{{-- ══════════════════════════════════════
     ARTICLE HERO
══════════════════════════════════════ --}}
<section class="post-hero font-body pt-16 pb-20 md:pt-20 md:pb-28">
    <div class="container mx-auto px-6 lg:px-8 max-w-3xl text-center relative z-10">

        <a href="{{ url('/resources') }}" class="back-link mb-8 mx-auto justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            All Resources
        </a>

        <p class="text-xs font-semibold tracking-[.2em] uppercase mt-6 mb-5 block" style="color: var(--sage);">
            Resources &amp; Insights
        </p>

        <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-bold leading-tight text-white mb-6">
            {{ $post->title }}
        </h1>

        <p class="text-sm tracking-wide" style="color: rgba(255,255,255,.45);">
            {{ $post->published_at->format('F j, Y') }}
        </p>

    </div>
</section>

{{-- ══════════════════════════════════════
     FEATURED IMAGE
══════════════════════════════════════ --}}
@if($post->hasMedia('featured_image'))
<div class="font-body bg-white">
    <div class="container mx-auto px-0 md:px-6 lg:px-8 max-w-5xl">
        <div class="-mt-10 md:-mt-14 relative z-10 shadow-xl overflow-hidden reveal">
            <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                 alt="{{ $post->title }}"
                 class="w-full object-cover"
                 style="max-height: 56vh;">
        </div>
    </div>
</div>
@endif

{{-- ══════════════════════════════════════
     ARTICLE BODY
══════════════════════════════════════ --}}
<section class="font-body py-16 md:py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-8 max-w-3xl">

        <div class="article-body reveal">
            {!! $post->content !!}
        </div>

    </div>
</section>

{{-- ══════════════════════════════════════
     ADDITIONAL IMAGES GALLERY
══════════════════════════════════════ --}}
@if($post->hasMedia('post_images'))
<section class="font-body py-16 md:py-20" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">

        <p class="text-xs font-semibold tracking-[.2em] uppercase mb-3 text-center" style="color: var(--sage);">Photo Gallery</p>
        <h2 class="font-display text-3xl md:text-4xl font-bold text-center mb-12" style="color: var(--forest);">
            Additional Images
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
            @foreach($post->getMedia('post_images') as $image)
                <div class="gallery-item reveal reveal-delay-{{ ($loop->index % 3) + 1 }}"
                     style="aspect-ratio: 4/3;"
                     onclick="openLightbox('{{ $image->getUrl() }}')">
                    <img src="{{ $image->getUrl() }}" alt="Gallery image {{ $loop->iteration }}">
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- Lightbox --}}
<div id="lightbox" onclick="closeLightbox()">
    <button id="lightbox-close" onclick="closeLightbox()">&times;</button>
    <img id="lightbox-img" src="" alt="">
</div>
@endif

{{-- ══════════════════════════════════════
     RELATED POSTS
══════════════════════════════════════ --}}
@if($related->count() > 0)
<section class="font-body py-16 md:py-24 bg-white" style="border-top: 1px solid var(--border);">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl">

        <p class="text-xs font-semibold tracking-[.2em] uppercase mb-3 text-center" style="color: var(--sage);">Continue Reading</p>
        <h2 class="font-display text-3xl md:text-4xl font-bold text-center mb-12" style="color: var(--forest);">
            Related Insights
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min($related->count(), 4) }} gap-6">
            @foreach($related as $relatedPost)
                <a href="{{ route('posts.show', $relatedPost->slug) }}"
                   class="related-card reveal reveal-delay-{{ $loop->index + 1 }} block">

                    <div class="related-card-image">
                        @if($relatedPost->hasMedia('featured_image'))
                            <img src="{{ $relatedPost->getFirstMediaUrl('featured_image') }}" alt="{{ $relatedPost->title }}">
                        @elseif($relatedPost->featured_image)
                            <img src="{{ $relatedPost->featured_image }}" alt="{{ $relatedPost->title }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="#a0b8a5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <p class="text-xs tracking-wide mb-2" style="color: var(--sage);">
                            {{ $relatedPost->published_at->format('M j, Y') }}
                        </p>
                        <h3 class="font-display text-lg font-bold leading-snug line-clamp-2 mb-3" style="color: var(--forest);">
                            {{ $relatedPost->title }}
                        </h3>
                        <span class="inline-flex items-center gap-1 text-xs font-semibold tracking-wide uppercase transition-colors" style="color: var(--jade);">
                            Read More
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </div>

                </a>
            @endforeach
        </div>

    </div>
</section>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    /* ── Scroll reveal ── */
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

    /* ── Reading progress bar ── */
    const bar     = document.getElementById('reading-progress');
    const article = document.querySelector('.article-body');
    if (bar && article) {
        window.addEventListener('scroll', () => {
            const rect  = article.getBoundingClientRect();
            const total = article.offsetHeight - window.innerHeight;
            const scrolled = Math.max(0, -rect.top);
            bar.style.width = Math.min(100, (scrolled / total) * 100) + '%';
        }, { passive: true });
    }

});

/* ── Lightbox ── */
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
@endpush

@endsection