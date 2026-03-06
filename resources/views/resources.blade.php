@extends('layouts.app')
@include('layouts.navigation')

@section('title', 'Resources | Nigeria-Japan Chamber of Commerce')

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

    .rule-diamond { display:flex; align-items:center; gap:12px; width:fit-content; }
    .rule-diamond::before,.rule-diamond::after { content:''; display:block; width:48px; height:1px; background:var(--sage); }
    .rule-diamond span { display:block; width:7px; height:7px; background:var(--jade); transform:rotate(45deg); }

    .reveal { opacity:0; transform:translateY(20px); transition:opacity .65s ease, transform .65s ease; }
    .reveal.visible { opacity:1; transform:none; }
    .reveal-delay-1 { transition-delay:.1s; }
    .reveal-delay-2 { transition-delay:.2s; }
    .reveal-delay-3 { transition-delay:.3s; }

    /* Hero */
    .resources-hero {
        background: var(--forest);
        position: relative; overflow: hidden;
    }
    .resources-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Post card */
    .post-card {
        display: flex; flex-direction: column;
        background: #fff;
        border: 1px solid var(--border);
        transition: border-color .3s, box-shadow .3s, transform .3s;
        overflow: hidden;
    }
    .post-card:hover {
        border-color: var(--sage);
        box-shadow: 0 8px 32px rgba(26,66,40,.08);
        transform: translateY(-3px);
    }

    /* Card image */
    .post-card-image {
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #edeae4;
        position: relative;
    }
    .post-card-image img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform .5s ease;
    }
    .post-card:hover .post-card-image img { transform: scale(1.04); }

    .post-card-image-placeholder {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
    }

    /* Category tag */
    .tag {
        display: inline-block;
        font-size: .65rem;
        font-weight: 600;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: var(--jade);
        background: #e8f2ec;
        padding: 3px 10px;
    }

    /* Featured post — spans full row */
    .post-card-featured {
        display: grid;
        grid-template-columns: 1fr;
    }
    @media (min-width: 768px) {
        .post-card-featured {
            grid-template-columns: 1fr 1fr;
        }
        .post-card-featured .post-card-image {
            aspect-ratio: unset;
            min-height: 380px;
        }
    }

    /* Pagination override */
    nav[aria-label="Pagination"] span[aria-current],
    nav[aria-label="Pagination"] .page-link-active {
        background: var(--forest) !important;
        color: #fff !important;
        border-color: var(--forest) !important;
    }
</style>
@endonce

{{-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ --}}
<section class="resources-hero font-body py-24 md:py-32">
    <div class="container mx-auto px-6 lg:px-8 max-w-4xl text-center relative z-10">

        <span class="text-xs font-semibold tracking-[.2em] uppercase mb-5 block" style="color: var(--sage);">
            Insights & Intelligence
        </span>

        <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight text-white">
            Resources
        </h1>

        <p class="text-base md:text-lg leading-relaxed max-w-xl mx-auto" style="color: rgba(255,255,255,.6);">
            Expert analysis, market updates, and strategic intelligence on Nigeria&#8209;Japan trade.
        </p>

    </div>
</section>

{{-- ══════════════════════════════════════
     POSTS
══════════════════════════════════════ --}}
<section class="font-body py-20 md:py-28" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-7xl">

        @forelse($posts as $post)

            {{-- ── First post: featured wide layout ── --}}
            @if($loop->first)
            <div class="post-card post-card-featured reveal mb-10 md:mb-14">

                <div class="post-card-image">
                    @if($post->featured_image)
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                    @else
                        <div class="post-card-image-placeholder" style="background:#dce8e1;">
                            <svg class="w-12 h-12" fill="none" stroke="#a0b8a5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="p-8 md:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="tag">Featured</span>
                        <span class="text-xs tracking-wide" style="color: var(--muted);">{{ $post->published_at->format('F j, Y') }}</span>
                    </div>

                    <h2 class="font-display text-3xl md:text-4xl font-bold mb-5 leading-snug" style="color: var(--forest);">
                        {{ $post->title }}
                    </h2>

                    <p class="text-base leading-relaxed mb-8" style="color: var(--muted);">
                        {{ Str::limit(strip_tags($post->excerpt ?: $post->content), 180) }}
                    </p>

                    <a href="{{ route('posts.show', $post->slug) }}"
                       class="inline-flex items-center gap-3 font-semibold text-sm tracking-[.08em] uppercase px-8 py-4 self-start transition-all duration-300 hover:opacity-90"
                       style="background: var(--forest); color: #fff;">
                        Read Article
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

            </div>

            {{-- ── Remaining posts: 3-col grid ── --}}
            @if(!$loop->last)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @endif

            @elseif($loop->last && $loop->count > 1)

                {{-- last card inside grid --}}
                <div class="post-card reveal reveal-delay-{{ (($loop->index - 1) % 3) + 1 }}">
                    <div class="post-card-image">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                        @else
                            <div class="post-card-image-placeholder" style="background:#dce8e1;">
                                <svg class="w-10 h-10" fill="none" stroke="#a0b8a5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 md:p-7 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs tracking-wide" style="color: var(--muted);">{{ $post->published_at->format('M j, Y') }}</span>
                        </div>
                        <h3 class="font-display text-xl md:text-2xl font-bold mb-3 leading-snug line-clamp-2" style="color: var(--forest);">
                            {{ $post->title }}
                        </h3>
                        <p class="text-sm leading-relaxed mb-6 line-clamp-3 flex-grow" style="color: var(--muted);">
                            {{ Str::limit(strip_tags($post->excerpt ?: $post->content), 120) }}
                        </p>
                        <a href="{{ route('posts.show', $post->slug) }}"
                           class="mt-auto inline-flex items-center gap-2 text-sm font-semibold transition-colors"
                           style="color: var(--jade);"
                           onmouseover="this.style.color='var(--forest)'" onmouseout="this.style.color='var(--jade)'">
                            Read More
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>{{-- close grid --}}

            @else

                {{-- middle cards --}}
                <div class="post-card reveal reveal-delay-{{ (($loop->index - 1) % 3) + 1 }}">
                    <div class="post-card-image">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                        @else
                            <div class="post-card-image-placeholder" style="background:#dce8e1;">
                                <svg class="w-10 h-10" fill="none" stroke="#a0b8a5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 md:p-7 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs tracking-wide" style="color: var(--muted);">{{ $post->published_at->format('M j, Y') }}</span>
                        </div>
                        <h3 class="font-display text-xl md:text-2xl font-bold mb-3 leading-snug line-clamp-2" style="color: var(--forest);">
                            {{ $post->title }}
                        </h3>
                        <p class="text-sm leading-relaxed mb-6 line-clamp-3 flex-grow" style="color: var(--muted);">
                            {{ Str::limit(strip_tags($post->excerpt ?: $post->content), 120) }}
                        </p>
                        <a href="{{ route('posts.show', $post->slug) }}"
                           class="mt-auto inline-flex items-center gap-2 text-sm font-semibold transition-colors"
                           style="color: var(--jade);"
                           onmouseover="this.style.color='var(--forest)'" onmouseout="this.style.color='var(--jade)'">
                            Read More
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- close grid after last item in loop --}}
                @if($loop->last)</p>
                </div>
                @endif

            @endif

        @empty
            {{-- Empty state --}}
            <div class="text-center py-24 reveal">
                <div class="mx-auto w-16 h-16 mb-6 flex items-center justify-center" style="background:#e8f2ec;">
                    <svg class="w-8 h-8" fill="none" stroke="#74a98a" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="font-display text-2xl font-bold mb-2" style="color: var(--forest);">No resources yet</p>
                <p class="text-sm" style="color: var(--muted);">Check back soon — articles and insights are coming.</p>
            </div>
        @endforelse

        {{-- ── Pagination ── --}}
        @if($posts->hasPages())
        <div class="mt-14 flex justify-center reveal">
            {{ $posts->links('pagination::tailwind') }}
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