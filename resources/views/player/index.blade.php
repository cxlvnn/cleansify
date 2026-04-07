<x-layout>
  <div class="bg-base min-h-screen">
    <div class="mx-auto max-w-4xl px-6">

      <div class="mb-8 text-center">
        <h1 class="mb-3 text-4xl font-semibold text-white">Recitations</h1>
      </div>

      @if ($recitations->count())
        <div class="space-y-5">
          <a href="/recitations/upload"
            class="inline-flex items-center gap-2 rounded-2xl bg-zinc-800 px-6 py-3 text-sm font-medium text-white transition-colors hover:bg-zinc-700">
            <span>Upload Recitation</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
          </a>
      @endif

      <div class="overflow-hidden rounded-3xl border border-zinc-800 bg-zinc-900/70 backdrop-blur-md">

        @forelse($recitations as $index => $recitation)
          <div
            class="group grid grid-cols-12 items-center gap-4 border-b border-zinc-800/50 px-6 py-4 transition-colors last:border-b-0 hover:bg-zinc-800/30">

            <div class="col-span-7">
              <p class="recitation-title font-medium text-white">{{ $recitation->name }}</p>
              <p class="reciter-name text-sm text-zinc-400">{{ $recitation->reciter_name }}</p>
            </div>

            <div class="col-span-5 flex items-center justify-end gap-3">

              <div class="flex items-center gap-2 opacity-0 transition-opacity group-hover:opacity-100">
                <a href="/recitations/edit/{{ $recitation->id }}"
                  class="rounded-full p-2 text-zinc-400 transition-colors hover:bg-zinc-700/50 hover:text-emerald-400"
                  title="Edit">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
                </a>

                <form action="/recitations/{{ $recitation->id }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this recitation?');">
                  @csrf

                  @method('DELETE')
                  <button type="submit"
                    class="rounded-full p-2 text-zinc-400 transition-colors hover:bg-zinc-700/50 hover:text-red-500"
                    title="Delete">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m5-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </form>
              </div>

              <button
                class="row-play-btn flex h-10 w-10 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-500 transition-all hover:bg-emerald-500 hover:text-black focus:outline-none"
                data-index="{{ $index }}" data-src="/storage/{{ $recitation->path }}">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </button>
            </div>
          </div>
        @empty
          <div class="p-10 text-center">
            <p class="text-lg text-zinc-400">No recitations found yet.</p>
            <a href="/recitations/upload" class="mt-4 inline-block text-emerald-400 hover:text-emerald-300">
              Upload your first recitation →
            </a>
          </div>
        @endforelse

      </div>
    </div>

  </div>
  </div>

  <div id="master-player"
    class="fixed bottom-0 left-0 right-0 z-50 translate-y-full transform border-t border-zinc-800 bg-zinc-900/95 backdrop-blur-xl transition-transform duration-300 ease-out">
    <audio id="global-audio" preload="metadata"></audio>

    <div class="mx-auto grid max-w-4xl grid-cols-12 items-center gap-4 px-6 py-4">

      <div class="col-span-3 flex min-w-0 flex-col">
        <span id="active-title" class="truncate font-medium text-white">Title</span>
        <span id="active-reciter" class="truncate text-sm text-zinc-400">Reciter</span>
      </div>

      <div class="col-span-6 flex flex-col items-center gap-1">
        <div class="flex items-center gap-5">
          <button id="master-shuffle" class="text-zinc-400 transition-colors hover:text-white" title="Toggle Shuffle">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4l5 5m11-5l-5 5M4 20l5-5m11 5l-5-5M16 4h4v4M16 20h4v-4M4 4l16 16" />
            </svg>
          </button>

          <button id="master-prev" class="text-zinc-400 transition-colors hover:text-white" title="Previous">
            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
              <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z" />
            </svg>
          </button>

          <button id="master-play-btn"
            class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-500 text-black transition-all hover:bg-emerald-600 focus:outline-none">
            <svg id="m-play-icon" class="h-5 w-5 fill-current" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7z" />
            </svg>
            <svg id="m-pause-icon" class="hidden h-5 w-5 fill-current" viewBox="0 0 24 24">
              <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
            </svg>
          </button>

          <button id="master-next" class="text-zinc-400 transition-colors hover:text-white" title="Next">
            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
              <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z" />
            </svg>
          </button>

          <button id="master-repeat" class="text-zinc-400 transition-colors hover:text-white" title="Repeat Track">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
          </button>
        </div>

        <div class="flex w-full items-center gap-3 font-mono text-xs text-zinc-400">
          <span id="m-current-time" class="min-w-[65px] text-right">0:00</span>
          <div id="m-progress-container" class="group relative h-1.5 flex-1 cursor-pointer rounded-full bg-zinc-700">
            <div id="m-progress-bar"
              class="absolute h-full w-0 rounded-full bg-emerald-500 transition-all duration-100"></div>
          </div>
          <span id="m-total-duration" class="min-w-[65px] text-left">0:00</span>
        </div>
      </div>

      <div class="col-span-3 flex items-center justify-end gap-2">
        <svg class="h-4 w-4 text-zinc-400" fill="currentColor" viewBox="0 0 24 24">
          <path d="M5 17h4l5 5V2l-5 5H5v10zm14-5c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z" />
        </svg>
        <input id="volume-slider" type="range" min="0" max="1" step="0.01" value="0.75"
          class="h-1 w-20 cursor-pointer appearance-none rounded-lg bg-zinc-700 accent-emerald-500">
      </div>
    </div>
  </div>
</x-layout>
