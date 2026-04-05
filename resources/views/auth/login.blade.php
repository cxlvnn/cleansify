<x-layout>
<div class="max-w-md mx-auto bg-base-100 rounded-box shadow-md overflow-hidden p-6">
  <form class="space-y-4" method="POST" action="/login">
    @csrf

    <div>
      <label for="reciter_name" class="block text-sm font-medium text-base-content mb-1">
        Email
      </label>
      <input
        type="email"
        id="email"
        name="email"
        required
        class="w-full px-3 py-2 bg-base-200 border border-base-300 text-base-content placeholder-base-content/50 rounded-field focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
        placeholder="Enter your email"
      />
    </div>

    <div>
      <label for="reciter_name" class="block text-sm font-medium text-base-content mb-1">
        Password
      </label>
      <input
        type="password"
        id="password"
        name="password"
        required
        class="w-full px-3 py-2 bg-base-200 border border-base-300 text-base-content placeholder-base-content/50 rounded-field focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
        placeholder="Enter your password"
      />
    </div>
    <x-error name='email'/>

    <button
      type="submit"
      class="w-full btn bg-primary text-primary-content py-3 px-4 rounded-field hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-base-100 transition-colors">
      Sign In
    </button>
  </form>
</div>
</x-layout>
