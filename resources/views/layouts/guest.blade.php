<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JobYaari') }} - {{ __('Login') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="background: linear-gradient(135deg, #0D6EFD 0%, #6610F2 100%); min-height: 100vh; font-family: 'Poppins', sans-serif;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="text-center mb-6">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <h1 class="text-white fw-bold mb-2" style="font-size: 2.5rem;">
                        <i class="bi bi-briefcase-fill me-2"></i>JobYaari
                    </h1>
                    <p class="text-white opacity-75">Your Career Journey Starts Here</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg overflow-hidden" style="border-radius: 16px;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
