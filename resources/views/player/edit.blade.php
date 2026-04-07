<x-layout>
  <div class="bg-base-100 rounded-box mx-auto max-w-md overflow-hidden p-6 shadow-md">
    <form class="space-y-4" method="POST" action="/recitations/{{ $recitation->id }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div>
        <label for="name" class="text-base-content mb-1 block text-sm font-medium">
          Surah name
        </label>
        <input type="text" id="name" name="name" value="{{ $recitation->name }}" required
          class="bg-base-200 border-base-300 text-base-content placeholder-base-content/50 rounded-field focus:ring-primary focus:border-primary w-full border px-3 py-2 focus:outline-none focus:ring-2" />
      </div>
      <div>
        <label for="reciter_name" class="text-base-content mb-1 block text-sm font-medium">
          Reciter's name
        </label>
        <input type="text" id="reciter_name" name="reciter_name" value="{{ $recitation->reciter_name }}"required
          class="bg-base-200 border-base-300 text-base-content placeholder-base-content/50 rounded-field focus:ring-primary focus:border-primary w-full border px-3 py-2 focus:outline-none focus:ring-2" />
      </div>
      <div>
        <label for="recitation" class="text-base-content mb-1 block text-sm font-medium">
          Recitation
        </label>
        <input type="file" id="recitation" name="recitation" required
          class="bg-base-200 border-base-300 text-base-content rounded-field focus:ring-primary focus:border-primary file:rounded-field file:bg-primary file:text-primary-content hover:file:bg-primary/90 w-full border px-3 py-2 file:mr-4 file:border-0 file:px-4 file:py-2 file:text-sm file:font-medium focus:outline-none focus:ring-2" />
      </div>
      <button type="submit"
        class="btn bg-primary text-primary-content rounded-field hover:bg-primary/90 focus:ring-primary focus:ring-offset-base-100 w-full px-4 py-3 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2">
        Edit
      </button>
    </form>
  </div>
</x-layout>
