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


@livewireStyles

<!-- Scripts -->

</head>
<body class="font-sans antialiased ">
<x-jet-banner/>

<div class="min-h-screen dark:bg-gray-800 flex flex-col">
@livewire('navigation-menu')

<!-- Page Content -->
    <main class="flex flex-1">
        <x-sidebar-menu class="w-1/6"></x-sidebar-menu>


            {{$slot}}


    </main>

    <div class="mt-3 absolute bottom-10 right-5 dark:text-white"><label>Switch</label>
        <div class="mt-2">
            <input @click="toggle === '0' ? toggle = '1' : toggle = '0'"
                   type="checkbox"
                   class="input input--switch border">
        </div>
    </div>
</div>


@stack('modals')
@livewireScripts


<script src="{{ mix('js/app.js') }}"></script>

@stack('scripts')


</body>
</html>
