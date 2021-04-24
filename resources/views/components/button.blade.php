@props(['background' => 'blue', 'color'=>"white"])


<button {{ $attributes->merge(['class' => "bg-$background-700 py-2 px-4 rounded-md text-$color transform transition hover:scale-95 hover:bg-$background-800"]) }}>{{$slot}}</button>
