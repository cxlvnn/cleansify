<x-layout>
<div class="max-w-md mx-auto bg-emerald-900 rounded-2xl shadow-md overflow-hidden p-6">
  <form class="space-y-4" method="POST" action="/recitations" enctype="multipart/form-data">
    @csrf
    <div>
      <label for="name" class="block text-sm font-medium text-emerald-100 mb-1">
        Surah name
      </label>
      <input
        type="text"
        id="name"
        name="name"
        required
        class="w-full px-3 py-2 bg-emerald-950 border border-emerald-700 text-emerald-100 placeholder-emerald-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
        placeholder="Enter surah name"
      />
    </div>
    <div>
      <label for="reciter_name" class="block text-sm font-medium text-emerald-100 mb-1">
        Reciter's name
      </label>
      <input
        type="text"
        id="reciter_name"
        name="reciter_name"
        required
        class="w-full px-3 py-2 bg-emerald-950 border border-emerald-700 text-emerald-100 placeholder-emerald-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
        placeholder="Enter reciter's name"
      />
    </div>
    <div>
      <label for="recitation" class="block text-sm font-medium text-emerald-100 mb-1">
        Recitation
      </label>
      <input
        type="file"
        id="recitation"
        name="recitation"
        required
        class="w-full px-3 py-2 bg-emerald-950 border border-emerald-700 text-emerald-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-700 file:text-emerald-100 hover:file:bg-emerald-600"
      />
    </div>
    <button
      type="submit"
      class="w-full bg-emerald-600 text-white py-3 px-4 rounded-xl hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-emerald-900 transition-colors">
      Upload
    </button>
  </form>
</div>
</x-layout>
