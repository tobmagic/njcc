<section class="font-body py-10 md:py-32" style="background: var(--cream);">
    <div class="container mx-auto px-6 lg:px-8 max-w-7xl">
        <div class="text-center mb-4 md:mb-20">
            <p class="reveal text-xs font-semibold tracking-[0.2em] uppercase mb-6" style="color: var(--sage);">
                Latest Insights
            </p>
            <div class="rule-diamond reveal reveal-delay-1 mx-auto"><span></span></div>
            <h2 class="font-display reveal reveal-delay-1 text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight" style="color: var(--forest);">
                Resources & Insights
            </h2>
            <p class="reveal reveal-delay-2 text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                Expert analysis, market updates, and strategic intelligence on Nigeria-Japan trade.
            </p>
        </div>

        @if($latestPosts->isEmpty())
            <p class="text-center text-gray-600 py-12 text-lg">No resources available yet. Check back soon!</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                @foreach($latestPosts as $post)
                    <article class="reveal reveal-delay-{{ $loop->iteration }} bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
                        <div class="h-60 overflow-hidden bg-gray-100">
                            @if ($post->hasMedia('featured_image'))
                                <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">No image</div>
                            @endif
                        </div>

                        <div class="p-6 md:p-8 flex-grow flex flex-col">
                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-3">
                                {{ $post->published_at->format('F j, Y') }}
                            </span>
                            <h3 class="font-display text-xl font-bold mb-4 line-clamp-2" style="color: var(--forest);">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-600 mb-8 line-clamp-3 flex-grow">
                                {{ Str::limit(strip_tags($post->excerpt ?: $post->content), 100) }}
                            </p>
                            <a href="{{ route('posts.show', $post->slug) }}" 
                               class="group inline-flex items-center text-[var(--jade)] font-bold transition-colors hover:text-[var(--forest)]">
                                Read More
                                <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-16 reveal reveal-delay-3">
            <a href="{{ url('/our-resources') }}"
               class="inline-flex items-center gap-3 font-semibold text-lg tracking-wide uppercase px-10 py-4 transition-all duration-300 hover:bg-opacity-90"
               style="background: var(--forest); color: #fff; border-radius: 9999px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                View All Resources
            </a>
        </div>
    </div>
</section>