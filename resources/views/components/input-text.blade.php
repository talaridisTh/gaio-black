<div {{ $attributes->merge(['class' => 'p-2 ']) }}>

    <label for="{{$id}}"
           class="block text-sm font-medium dark:text-gray-200">{{$value}}</label>

    <div class="relative">

        <span class="absolute rounded-l h-full @isset($text) flex @else hidden @endisset items-center justify-center dark:bg-gray-300 dark:bg-dark-1 dark:border-dark-4 border dark:text-gray-800 px-3">
            {{ $text ?? '' }}
        </span>
        <span class="absolute rounded-l h-full @isset($feather) flex @else hidden @endisset items-center justify-center dark:bg-gray-300 dark:bg-dark-1 dark:border-dark-4 border dark:text-gray-800 px-3">
            {{ $feather ?? '' }}
        </span>

        <input type="text"
               name="{{$id}}"
               id="{{$id}}"
               autocomplete="off"
               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 @isset($feather) pl-14 @endisset @isset($text) pl-14 @endisset
                block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800">
    </div>

</div>