<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head.head')
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="absolute top-4 right-4 z-50">
            <x-theme-toggle />
        </div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

            <div>
                <a href="{{env('APP_URL')}}">
                    <i class="fa fa-2x fa-calendar text-black/50 dark:text-gray-300"></i>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

    </body>
</html>
