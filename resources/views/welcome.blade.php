<x-layout>
    <div class="relative min-h-[80vh] flex flex-col justify-center">
        <div class="fixed top-0 left-1/2 -z-10 h-[400px] w-full -translate-x-1/2 rounded-full bg-emerald-500/5 blur-[120px]"></div>

        <main class="mx-auto max-w-5xl px-6 text-center">
            <h1 class="mb-6 text-5xl font-extrabold tracking-tight text-white sm:text-8xl">
                Focus on the <span class="text-emerald-500 text-glow">Recitation.</span>
            </h1>

            <p class="mx-auto mb-12 max-w-xl text-lg leading-relaxed text-zinc-500 sm:text-xl">
                A minimalist library for your Quranic audio collection.
                Simple management, high-fidelity playback.
            </p>

            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                @auth
                    <a href="/recitations" class="group flex items-center gap-2 rounded-full bg-emerald-500 px-10 py-4 text-lg font-semibold text-black transition-all hover:scale-105 active:scale-95">
                        Open Library
                        <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="rounded-full bg-white px-10 py-4 text-lg font-semibold text-black transition-all hover:scale-105 active:scale-95">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="px-10 py-4 text-lg font-semibold text-zinc-400 hover:text-white transition-colors">
                        Sign In
                    </a>
                @endauth
            </div>
        </main>

        <section class="mx-auto mt-32 w-full max-w-7xl px-6">
            <div class="grid gap-12 sm:grid-cols-3 border-t border-zinc-900/50 pt-16">
                <div class="space-y-2">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-white">Lossless</h3>
                    <p class="text-sm leading-relaxed text-zinc-500">Native support for high-quality audio files.</p>
                </div>
                <div class="space-y-2">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-white">Persistent</h3>
                    <p class="text-sm leading-relaxed text-zinc-500">Listen seamlessly while you browse your collection.</p>
                </div>
                <div class="space-y-2">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-white">Focused</h3>
                    <p class="text-sm leading-relaxed text-zinc-500">Zero distractions. Just the recitations you love.</p>
                </div>
            </div>
        </section>
    </div>

    <style>
        .text-glow {
            text-shadow: 0 0 30px rgba(16, 185, 129, 0.2);
        }
    </style>
</x-layout>
