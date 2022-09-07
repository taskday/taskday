<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="manifest" href="/manifest.json" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="description" content="Task Day: your day to day task management">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="TaskDay">
    <meta name="apple-mobile-web-app-title" content="TaskDay">
    <meta name="msapplication-starturl" content="/">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicons/192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicons/150.png">
    <meta name="theme-color" content="#3b82f6">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

    {{-- Ziggy to access laravel routes from javascript --}}
    @routes

    {{-- Taskday plugins --}}
    @taskday

    {{-- Assets --}}
    @vite('resources/app.ts')
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-900">
    @inertia
</body>

</html>
