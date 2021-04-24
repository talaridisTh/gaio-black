<?php

namespace App\Http\Livewire\Admin\Storage;

use App\Models\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class UpdateStorage extends Component {

    public $name;
    public $storage;
    public $description;
    public $sku;
    public $mm = 0;
    public $price = 0;
    public $quantity = 0;

    protected $rules = [
        "name" => "required",
        "price" => "required",
        "quantity" => "required|numeric|min:1",
    ];

    public function mount(Storage $storage)
    {
        $this->storage = $storage;
        $this->name = $storage->name;
        $this->description = $storage->description;
        $this->sku = $storage->sku;
        $this->mm = $storage->mm;
        $this->price = $storage->price;
        $this->quantity = $storage->quantity;
    }

    public function updated($name)
    {
        $this->validateOnly($name);

    }

    public function updateStorage()
    {

        $this->validate();


        $this->storage->update([
            "name" => $this->name,
            "description" => $this->description,
            "sku" => $this->sku,
            "mm" => $this->mm,
            "price" => $this->price,
            "quantity" => $this->quantity,
        ]);
        $this->emitSelf("update-event");
    }

    public function render()
    {
        return view('livewire.admin.storage.update-storage');
    }

}