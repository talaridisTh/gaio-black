<div {{ $attributes->merge(['class' => 'p-2']) }}>

    <label for="{{$id}}"
           class="block text-sm font-medium dark:text-gray-200">{{$value}}</label>


        @if(in_array($type,["password","text"]))
        <div class="relative">
            <span class="absolute rounded-l h-full @isset($text) flex @else hidden @endisset items-center justify-center dark:bg-gray-300 dark:bg-dark-1 dark:border-dark-4 border dark:text-gray-800 px-3">
            {{ $text ?? '' }}
        </span>
            <span  class="absolute rounded-l h-full @isset($feather) flex @else hidden @endisset items-center justify-center dark:bg-gray-300 dark:bg-dark-1 dark:border-dark-4 border dark:text-gray-800 px-3">
            {{ $feather ?? '' }}
        </span>
            <input type="{{$type}}"
                   name="{{$id}}"
                   id="{{$id}}"
                   autocomplete="off"
                   placeholder="Εισάγετε {{$value}}.."
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 @isset($feather) pl-14 @endisset @isset($text) pl-14 @endisset
                    block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800">
        </div>
            @error($id) <span class="error">{{ $message }}</span> @enderror


        @elseif($type == "textarea")
            <div class="mt-1">
                <textarea id="{{$id}}"
                          name="{{$id}}"
                          rows="3"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500
                              mt-1 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800"
                          placeholder="Εισάγετε {{$value}}...">{{$slot}}</textarea>
            </div>

        @elseif($type == "select")
            <select class="form-select dark:bg-gray-800 mt-1 block w-full"
                    id="{{$id}}"
                    name="{{$id}}">
                @foreach($user as $u)
                    <option value="">{{$u}}</option>
                @endforeach

            </select>
        @endif

    </div>