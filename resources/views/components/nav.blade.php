<nav class="border-b border-border px-6">
    <div class="max-w-7x1 mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="/" class="text-2xl">Cleansify</a>
        </div>

        @guest
        <div>
            <div class="flex gap-5 items-center">
                <a href="/login">Login</a>
                <a href="/register" class="btn btn-primary">Register</a>
            </div>
        </div>
        @endguest

        @auth
        <div>
            <div class="flex gap-5 items-center">
                <form action="/logout" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn">Logout</button>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
