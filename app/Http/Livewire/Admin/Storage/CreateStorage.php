<?php

namespace App\Http\Livewire\Admin\Storage;

use App\Models\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateStorage extends Component {

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public $name;
    public $description;
    public $sku;
    public $mm;
    public $price;
    public $quantity;

    protected $rules = [
        "name" => "required",
        "price" => "required",
        "quantity" => "required|numeric|min:1",
    ];

    public function updated($name)
    {
        $this->validateOnly($name);

    }

    public function submit()
    {
        $this->validate();

        Storage::create([
            "name" => $this->name,
            "slug" => Str::slug($this->name, "-"),
            "description" => $this->description,
            "sku" => $this->sku,
            "mm" => $this->mm,
            "price" => $this->price,
            "quantity" => $this->quantity,
        ]);

        return redirect(route("storage.index"));
    }

    public function render()
    {

        return view('livewire.admin.storage.create-storage');
    }

}
