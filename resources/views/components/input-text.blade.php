<div class="{{ isset($className) ?   $className." p-2" :'p-2' }}">

    <label for="{{$id}}"
           class="block text-sm font-medium dark:text-gray-200">{{$label??''}}</label>

    <div class="relative">

        <span
         class="absolute rounded-l h-full @isset($text) flex @else hidden @endisset items-center justify-center dark:bg-gray-300 dark:bg-dark-1 dark:border-dark-4 border dark:text-gray-800 px-3">
            {{ $text ?? '' }}
        </span>
        <span
         class="absolute rounded-l h-full @isset($feather) flex @else hidden @endisset items-center justify-center dark:bg-gray-300 dark:bg-dark-1 dark:border-dark-4 border dark:text-gray-800 px-3">
            {{ $feather ?? '' }}
        </span>

        <input
         {{ $attributes->merge(['class' => 'my-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800']) }}
         type="{{ isset($type) ?   $type :'text' }}"
         value="{{ isset($value) ?   $value :'' }}"
         placeholder="{{$label??''}}"
         step="{{ isset($step) ?   $step :'' }}"
         name="{{$id}}"
         id="{{$id}}"

        >
        @error($id) <span class="mt-1 text-red-600">* {{ $message }}</span> @enderror
    </div>

</div>