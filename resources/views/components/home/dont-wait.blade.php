<section class="relative py-20 md:py-28 min-h-[60vh] md:min-h-[70vh] flex items-center justify-center overflow-hidden">

    <div class="absolute inset-0 z-0">
        <img 
            src="https://images.unsplash.com/photo-1540959733332-eab4f07e6c7d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
            alt="Modern Tokyo cityscape at night" 
            class="w-full h-full object-cover"
        >
         <img src="{{ asset('images/approach/p1.webp') }}" 
                         alt="Partnership-First Philosophy" 
                         class="w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/65"></div>
    </div>

  
    <div class="relative z-10 container mx-auto px-6 lg:px-8 max-w-5xl text-center">

        <div class="reveal">
            <h2 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 md:mb-8 leading-tight text-white drop-shadow-2xl">
                Don't Wait.<br>The Opportunity Is Here.<br>The Time Is Now.
            </h2>

            <p class="text-lg md:text-xl lg:text-2xl mb-10 md:mb-12 max-w-4xl mx-auto text-white/90 drop-shadow-md">
                Contact us today to schedule a consultation or to learn more about our services and how we can support your Nigeria-Japan business goals.
            </p>

            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-3 font-semibold text-lg md:text-xl tracking-wide uppercase px-10 md:px-14 py-5 md:py-6 transition-all duration-300 bg-white text-[var(--forest)] hover:bg-gray-100 rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/50">
                Get In Touch Now
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

    </div>

    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
        <svg class="w-10 h-10 md:w-12 md:h-12 text-white opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </div>
</section>