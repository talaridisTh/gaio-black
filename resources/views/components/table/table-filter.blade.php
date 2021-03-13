<div wire:ignore
     class="flex justify-between items-center px-16">

    <x-select2 name="filter-entries"
               id="filter-entries">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="100">100</option>
        <option value="1000">Όλα</option>

        <x-slot name="attr"></x-slot>

    </x-select2>

    <div class="relative text-gray-600 focus-within:text-gray-400">
                  <span class="absolute inset-y-4 top-2 left-0 flex items-center pl-2">
                    <button type="submit"
                            class="p-1 focus:outline-none focus:shadow-outline">
                        <i class="w-5"
                           data-feather="search"></i>
                     </button>
                  </span>

        <input wire:model.debounce.750ms="search"
               type="search"
               class="py-2 mb-2 text-sm text-white bg-gray-900 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900"
               placeholder="Search..."
               autocomplete="off">
    </div>

</div>