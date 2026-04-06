<x-layout>
    <div class="bg-base min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-6">

            <div class="text-center mb-12">
                <h1 class="text-4xl font-semibold text-white mb-3">Recitations</h1>
            </div>

            <div class="space-y-5">
                <a href="/recitations/upload"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-zinc-800 hover:bg-zinc-700 transition-colors rounded-2xl text-sm font-medium text-white">
                    <span>Upload Recitation</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </a>

                <div class="bg-zinc-900/70 backdrop-blur-md border border-zinc-800 rounded-3xl py-5 px-5 space-y-4">

                    @forelse($recitations as $recitation)
                        <div class="grid grid-cols-8 items-center gap-4">
                            <div class="col-span-3 text-center">
                                <p class="text-white font-medium">{{ $recitation->reciter_name }}</p>
                                <p class="text-zinc-400 text-sm">{{ $recitation->name }}</p>
                            </div>

                            <div class="col-span-5 custom-audio-player" data-src="/storage/{{ $recitation->path }}">
                                <audio class="native-audio" src="/storage/{{ $recitation->path }}"
                                    preload="metadata"></audio>

                                <div
                                    class="flex items-center gap-4 bg-zinc-800/50 p-3 rounded-2xl border border-zinc-700/50">
                                    <button
                                        class="play-btn w-10 h-10 flex items-center justify-center bg-emerald-500 hover:bg-emerald-600 text-black rounded-full transition-all focus:outline-none">
                                        <svg class="play-icon w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                        <svg class="pause-icon w-5 h-5 fill-current hidden" viewBox="0 0 24 24">
                                            <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                        </svg>
                                    </button>

                                    <div class="flex-1 flex flex-col gap-1">
                                        <div class="flex justify-between text-xs text-zinc-400">
                                            <span class="current-time">0:00</span>
                                            <span class="total-duration">0:00</span>
                                        </div>
                                        <div
                                            class="progress-container relative w-full h-2 bg-zinc-700 rounded-full cursor-pointer group">
                                            <div
                                                class="progress-bar absolute h-full bg-emerald-500 rounded-full w-0 group-hover:bg-emerald-400 transition-colors">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button
                                            class="shuffle-btn w-8 h-8 flex items-center justify-center text-zinc-400 hover:text-white transition-colors"
                                            title="Toggle Shuffle">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4l5 5m11-5l-5 5M4 20l5-5m11 5l-5-5M16 4h4v4M16 20h4v-4M4 4l16 16" />
                                            </svg>
                                        </button>

                                        <button
                                            class="next-btn w-8 h-8 flex items-center justify-center text-zinc-400 hover:text-white transition-colors"
                                            title="Next Recitation">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-zinc-900/50 border border-zinc-800 rounded-3xl p-12 text-center">
                            <p class="text-zinc-400 text-lg">No recitations found yet.</p>
                            <a href="/recitations/upload"
                                class="text-emerald-400 hover:text-emerald-300 mt-4 inline-block">
                                Upload your first recitation →
                            </a>
                        </div>
                    @endforelse

                </div>
            </div>
            <div>
            </div>

        </div>
    </div>
    <script type="module" src="https://cdn.jsdelivr.net/npm/player.style/tailwind-audio/+esm"></script>
</x-layout>
