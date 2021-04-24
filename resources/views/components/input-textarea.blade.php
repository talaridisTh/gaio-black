<div class="p-2">
    <label for="{{$id}}"
           class="block text-sm font-medium dark:text-gray-200">{{$label}}</label>

    <textarea
     {{ $attributes->merge(['class' => 'my-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800']) }}
     rows="3"
     class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500
                  mt-1 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800"
     placeholder="Εισάγετε {{$label}}...">{{$slot}}</textarea>
</div>