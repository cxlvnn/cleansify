<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cleansify</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-background text-foreground">

    <x-nav />

    <main class="max-w-7x1 mx-auto py-10">
        {{ $slot }}
    </main>
</body>

</html>
