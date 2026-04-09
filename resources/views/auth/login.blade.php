<x-layout>
  <div class="bg-base-100 rounded-box mx-auto max-w-md overflow-hidden p-6 shadow-md">
    <form class="space-y-4" method="POST" action="/login">
      @csrf

      <div class="border-base-200 mb-6 space-y-2 border-b pb-2 text-center">
        <h1 class="from-primary to-secondary text-primary bg-clip-text text-2xl font-bold">
          Welcome back
        </h1>
        <p class="text-base-content/70 text-sm">
            Sign in to continue your journey
        </p>
      </div>


      <div>
        <label for="reciter_name" class="text-base-content mb-1 block text-sm font-medium">
          Email
        </label>
        <input type="email" id="email" name="email" required
          class="bg-base-200 border-base-300 text-base-content placeholder-base-content/50 rounded-field focus:ring-primary focus:border-primary w-full border px-3 py-2 focus:outline-none focus:ring-2"
          placeholder="Enter your email" />
      </div>

      <div>
        <label for="reciter_name" class="text-base-content mb-1 block text-sm font-medium">
          Password
        </label>
        <input type="password" id="password" name="password" required
          class="bg-base-200 border-base-300 text-base-content placeholder-base-content/50 rounded-field focus:ring-primary focus:border-primary w-full border px-3 py-2 focus:outline-none focus:ring-2"
          placeholder="Enter your password" />
      </div>
      <x-error name='email' />

      <button type="submit"
        class="btn bg-primary text-primary-content rounded-field hover:bg-primary/90 focus:ring-primary focus:ring-offset-base-100 w-full px-4 py-3 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2">
        Sign In
      </button>
    </form>
  </div>
</x-layout>
