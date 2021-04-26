<form wire:submit.prevent="addProduct" class="w-5/6">
    <div class="max-w-7xl mx-auto mt-10">
        @error('price.*') <span class="text-red-500">{{ $message }}</span> @enderror
        @error('quantity.*') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>


    <div class="max-w-7xl mx-auto flex space-x-10">
        <div class="flex-2" wire:ignore>
            <trix-editor wire:model.defer="description" input="rich-editor" class="text-white"></trix-editor>
            <input id="rich-editor" type="hidden" name="description">
        </div>
        <div x-data x-init="
             new Pikaday({ field: $refs.datepicker , format: 'DD/MM/YYYY',defaultDate: new Date(moment()),setDefaultDate: true });"
             class="relative flex-1 flex items-center mt-2">
            <input
             wire:model.lazy="date"
             x-ref="datepicker"
             class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white dark:bg-gray-800 font-medium"
             type="text"
             readonly
            >
            <div class="absolute top-9 right-0 px-3 py-2">
                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    <table class="border-collapse  max-w-7xl	w-full mx-auto text-gray-300 mt-20">
        <thead>
        <tr>
            <th class="border">Ονομα</th>
            <th class="border">Ποσοτητα</th>
            <th class="border">Μ.Μ.</th>
            <th class="border">Τιμη</th>
            <th class="border">Εκπτωση(%)</th>
            <th class="border">Συνολο</th>
        </tr>
        </thead>
        <tbody class="relative">

        @foreach(range(0,$row) as $key=> $i)
            <tr class="row{{$key}}">
                <td x-data="{isOpen : false}" class="border relative w-5/12">
                    <input wire:model.debounce.150ms="name.{{$key}}"
                           wire:keydown="$set('title',{{$key}})"
                           @keydown="isOpen = true/*, $wire.set('mm',''), $wire.set('price','') , $wire.set('quantity','')*/"
                           x-ref="inputName"
                           id="name" autocomplete="off" type="text"
                           class="my-1 block w-full sm:text-sm border-0  rounded-md dark:bg-gray-800">
                    @if($storages)
                        <ul x-show="isOpen"
                            class="absolute z-10 bg-gray-300 font-semibold text-gray-800 rounded px-2  py-1 left-0 right-0 h-64 scrollbar scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-100">
                            @foreach($storages as $storage)
                                <li @click="isOpen = false" wire:click="fillField({{$storage->id}} , {{$key}})"
                                    class="hover:bg-gray-400 cursor-pointer p-2 rounded">{{$storage->name}}</li>
                            @endforeach
                        </ul>
                    @endisset
                </td>
                <td class="border">
                    <input wire:keyup="totalUpdate({{$key}})" wire:model="quantity.{{$key}}" type="number"
                           class="my-1 block w-full sm:text-sm border-0  rounded-md dark:bg-gray-800 ">
                </td>
                <td class="border w-5%">
                    <input wire:model="mm.{{$key}}" type="text"
                           class="my-1 block w-full sm:text-sm border-0  rounded-md dark:bg-gray-800 " disabled>
                </td>
                <td class="border ">
                    <input wire:keyup="totalUpdate({{$key}})" wire:model="price.{{$key}}" type="number"
                           class="my-1 block w-full sm:text-sm border-0  rounded-md dark:bg-gray-800">
                </td>
                <td class="border ">
                    <input wire:keyup="totalUpdate({{$key}})" wire:model="offer.{{$key}}" type="number"
                           class="my-1 block w-full sm:text-sm border-0  rounded-md dark:bg-gray-800 ">
                </td>
                <td class="border ">
                    <input wire:model="total.{{$key}}" type="number"
                           class="my-1 block w-full sm:text-sm border-0  rounded-md dark:bg-gray-800 " disabled="">
                </td>
                <td>
                    <button class="focus:outline-none" x-data
                            x-on:click="document.querySelector('.row{{$row}}').classList.add('hidden')"
                            wire:click.prevent="minusRow({{$key}})">
                        <svg class="text-red-500 mt-2 cursor-pointer w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="max-w-7xl mx-auto flex justify-between">
        <button class="focus:outline-none" wire:click.prevent="plusRow">
                    <span wire:ignore>
                       <i data-feather="plus" class="text-green-500 mt-2 cursor-pointer"></i>
                    </span>
            <x-notification.update message="Συμπληροστε στο κενο πεδιο" notify-event="event-plus-row" />
        </button>

    </div>
    <div class="flex max-w-7xl mx-auto mt-10 justify-end items-center space-x-3">
        <x-notification.update notify-event="event-product" />
        <x-button background="scooter">Update</x-button>
    </div>
</form>
