<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{toggle: '1'}"
      :class="toggle==='1'? 'dark':''">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet"
          href="{{ mix('css/app.css') }}">

    <link rel="stylesheet"
          href="{{mix("css/plugin.css")}}">

    <link rel="stylesheet" href="https://www.unpkg.com/trix@1.3.1/dist/trix.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">


@livewireStyles

<!-- Scripts -->

</head>
<body class="font-sans antialiased ">

<div class="min-h-screen dark:bg-gray-800 flex flex-col">
@livewire('navigation-menu')

<!-- Page Content -->
    <main class="flex flex-1">
        <x-sidebar-menu class="w-1/6"></x-sidebar-menu>
        {{$slot}}
    </main>

    <div  x-data="{show:false}"
         x-show="show"
         @overlay.window="show=$event.detail.overlay"
         class="overlay-black z-40">
    </div>
        <x-modal />
</div>

@livewireScripts


<script src="{{ mix('js/app.js') }}"></script>

<script src="https://www.unpkg.com/moment@2.29.1/moment.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script src="https://www.unpkg.com/trix@1.3.1/dist/trix.js"></script>
@stack('scripts')


</body>
</html>
