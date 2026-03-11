<!-- resources/views/components/home/latest-posts-modal.blade.php -->

<style>
    #latest-posts-modal {
        transition: opacity .35s ease, visibility .35s ease;
    }
    #latest-posts-modal.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        display: flex !important; /* keep in DOM for transitions */
    }
    #latest-posts-modal.visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    /* Modal panel */
    .modal-panel {
        background: #fff;
        width: 92%;
        max-width: 600px;
        max-height: 90svh;
        overflow-y: auto;
        overscroll-behavior: contain;
        position: relative;
        transform: translateY(20px) scale(.98);
        opacity: 0;
        transition: transform .4s cubic-bezier(.2,.8,.3,1), opacity .35s ease;
        scrollbar-width: thin;
        scrollbar-color: #e2ddd6 transparent;
    }
    #latest-posts-modal.visible .modal-panel {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    /* Post row */
    .modal-post-row {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #e2ddd6;
        text-decoration: none;
        transition: background .2s;
        border-radius: 0;
    }
    .modal-post-row:last-child { border-bottom: none; }
    .modal-post-row:hover { background: #f6faf7; margin: 0 -24px; padding-left: 24px; padding-right: 24px; }

    .modal-thumb {
        flex-shrink: 0;
        width: 72px; height: 72px;
        overflow: hidden;
        background: #dce8e1;
    }
    @media (min-width: 640px) {
        .modal-thumb { width: 84px; height: 84px; }
    }
    .modal-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .modal-post-row:hover .modal-thumb img { transform: scale(1.07); }

    /* Close btn */
    .modal-close-btn {
        position: absolute; top: 16px; right: 16px;
        width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center;
        background: #f9f5ef;
        border: 1px solid #e2ddd6;
        color: #1a4228;
        font-size: 1.2rem; line-height: 1;
        cursor: pointer;
        transition: background .2s, border-color .2s;
        z-index: 10;
    }
    .modal-close-btn:hover { background: #e8f2ec; border-color: #74a98a; }

    /* NEW badge */
    .new-badge {
        display: inline-block;
        font-size: .6rem; font-weight: 700;
        letter-spacing: .1em; text-transform: uppercase;
        background: #1a4228; color: #fff;
        padding: 2px 6px;
        vertical-align: middle;
        margin-left: 6px;
    }

    /* Mobile: slide up from bottom */
    @media (max-width: 639px) {
        #latest-posts-modal { align-items: flex-end; }
        .modal-panel {
            width: 100%;
            max-width: 100%;
            max-height: 88svh;
            border-radius: 0;
            transform: translateY(40px) scale(1);
        }
        #latest-posts-modal.visible .modal-panel {
            transform: translateY(0) scale(1);
        }
    }
</style>

<div id="latest-posts-modal"
     class="fixed inset-0 z-[1001] flex items-center justify-center hidden bg-black/60 backdrop-blur-sm"
     role="dialog"
     aria-modal="true"
     aria-labelledby="modal-title">

    <div class="modal-panel font-body" style="font-family: 'DM Sans', sans-serif;">

        {{-- Header bar --}}
        <div class="px-6 pt-6 pb-5 md:px-8 md:pt-7" style="border-bottom: 1px solid #e2ddd6;">

            <button id="close-modal-btn" class="modal-close-btn" aria-label="Close">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <p class="text-xs font-semibold tracking-[.2em] uppercase mb-2" style="color: #74a98a;">
                Fresh from the Chamber
            </p>
            <h2 id="modal-title"
                class="text-2xl md:text-3xl font-bold leading-tight pr-10"
                style="font-family: 'Playfair Display', Georgia, serif; color: #1a4228;">
                Latest Insights
            </h2>
        </div>

        {{-- Posts list --}}
        <div class="px-6 md:px-8 py-2">
            @forelse($latestPosts->take(4) as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="modal-post-row group">

                    <div class="modal-thumb flex-shrink-0">
                        @if($post->hasMedia('featured_image'))
                            <img src="{{ $post->getFirstMediaUrl('featured_image', 'thumb') ?? $post->getFirstMediaUrl('featured_image') }}"
                                 alt="{{ $post->title }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-7 h-7" fill="none" stroke="#a0b8a5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold tracking-wide uppercase mb-1" style="color: #74a98a;">
                            {{ $post->published_at->format('M j, Y') }}
                            @if($loop->first)
                                <span class="new-badge">New</span>
                            @endif
                        </p>
                        <h3 class="font-semibold leading-snug line-clamp-2 text-sm md:text-base transition-colors"
                            style="font-family: 'Playfair Display', serif; color: #1a4228;">
                            {{ $post->title }}
                        </h3>
                        <p class="mt-1 text-xs leading-relaxed line-clamp-2 hidden sm:block" style="color: #5a5a5a;">
                            {{ $post->excerpt ?? Str::words(strip_tags($post->content), 18) }}
                        </p>
                    </div>

                    {{-- Arrow --}}
                    <svg class="w-4 h-4 flex-shrink-0 mt-1 opacity-0 group-hover:opacity-100 transition-opacity"
                         fill="none" stroke="#2d6a4f" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>

                </a>
            @empty
                <div class="py-12 text-center">
                    <p class="text-sm" style="color: #74a98a;">No recent insights yet. Check back soon!</p>
                </div>
            @endforelse
        </div>

        {{-- Footer --}}
        <div class="px-6 md:px-8 py-5" style="border-top: 1px solid #e2ddd6;">
            <a href="{{ url('/our-resources') }}"
               class="inline-flex items-center gap-3 font-semibold text-xs tracking-[.08em] uppercase px-8 py-3.5 transition-all duration-300 hover:opacity-90 w-full sm:w-auto justify-center"
               style="background: #1a4228; color: #fff;">
                View All Insights
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

    </div>
</div>

<script>
(function() {
    const modal    = document.getElementById('latest-posts-modal');
    const closeBtn = document.getElementById('close-modal-btn');
    if (!modal) return;

    const today       = new Date().toDateString();
    const lastShown   = localStorage.getItem('last_modal_show');
    const hasSeenToday = lastShown === today;

    function showModal() {
        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            requestAnimationFrame(() => modal.classList.add('visible'));
        });
        document.body.style.overflow = 'hidden';
        // Accessibility: focus the heading
        setTimeout(() => modal.querySelector('#modal-title')?.focus(), 400);
    }

    function closeModal() {
        modal.classList.remove('visible');
        setTimeout(() => modal.classList.add('hidden'), 350);
        document.body.style.overflow = '';
        localStorage.setItem('last_modal_show', today);
    }

    // Trigger: 20s delay OR 50% scroll depth, whichever comes first
    let shown = false;

    setTimeout(() => {
        if (!shown && !hasSeenToday) { shown = true; showModal(); }
    }, 20000);

    const onScroll = () => {
        if (shown || hasSeenToday) { window.removeEventListener('scroll', onScroll); return; }
        const pct = (window.scrollY + window.innerHeight) / document.body.scrollHeight;
        if (pct >= 0.50) {
            shown = true;
            showModal();
            window.removeEventListener('scroll', onScroll);
        }
    };
    window.addEventListener('scroll', onScroll, { passive: true });

    // Close handlers
    closeBtn?.addEventListener('click', closeModal);
    modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && modal.classList.contains('visible')) closeModal();
    });

    // Focus trap
    modal.addEventListener('keydown', e => {
        if (e.key !== 'Tab') return;
        const focusable = Array.from(modal.querySelectorAll('a, button, [href], input, [tabindex]:not([tabindex="-1"])'));
        const first = focusable[0];
        const last  = focusable[focusable.length - 1];
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    });
})();
</script>