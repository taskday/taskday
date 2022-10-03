<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-gray-50 dark:bg-gray-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="manifest" href="/build/manifest.webmanifest" />
    {{-- <link rel="icon" href="/favicon.ico"> --}}
    <meta name="description" content="Task Day: your day to day tasks manager">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="TaskDay">
    <meta name="apple-mobile-web-app-title" content="TaskDay">
    <meta name="msapplication-starturl" content="/">
    <meta name="msapplication-TileColor" content="#ffffff">
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

    {{-- Variables --}}
    <script>
        window.env = {
            pusherAppKey: "{{ config('taskday.pusher_app_key') }}",
            pusherAppCluster: "{{ config('taskday.pusher_app_cluster') }}",
            vapidPublicKey: "{{ config('taskday.vapid_public_key') }}",
        }
  </script>
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    @inertia
</body>

</html>
