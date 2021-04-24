<div class="w-5/6">
    <form wire:submit.prevent="updateStorage" class="p-8 grid grid-cols-2  gap-5">

        <x-card>
            <x-input-text wire:model.debounce.500ms="name" id="name" label="Τιτλος" />
            <x-input-textarea wire:model.defer="description" id="description" label="Περιγραφή" />
        </x-card>

        <x-card class="grid grid-cols-2">
            <x-input-text wire:model.defer="mm" id="mm" label="Μονάδα Μετρησης" />
            <x-input-text wire:model.defer="sku" id="sku" type="number" className="dark:bg-gray-900 border-none"
                          label="Κωδικός προιόντος" />
            <x-input-text wire:model.defer="price" id="price" step="any" type="number"
                          className="dark:bg-gray-900 border-none flex-1" label="Τιμή" />
            <x-input-text wire:model.defer="quantity" id="quantity" type="number"
                          className="dark:bg-gray-900 border-none flex-1" label="Ποσότητα" />
        </x-card>

        <div class="flex ">
            <x-button background="scooter">Update</x-button>
            <div class="flex items-center">
                <x-notification.update notify-event="update-event"/>
            </div>
        </div>

    </form>
</div>