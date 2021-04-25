<?php

namespace App\Http\Livewire\Admin\Storage;

use App\Models\Information;
use Illuminate\Support\Carbon;
use Livewire\Component;

class RemoveStorage extends Component {

    public $name = [];
    public $description = "";
    public $total = [];
    public $offer = [];
    public $date;
    public $price = [];
    public $quantity = [];
    public $mm = [];
    public $title = 0;
    public $row = 0;
    public $key = 0;
    public $this = 0;

    public function fillField($storage, $key)
    {

        $item = \App\Models\Storage::find($storage);
        $this->name[$key] = $item->name;
        $this->price[$key] = $item->price;
        $this->mm[$key] = $item->mm;
        $this->offer[$key] = 0;
        $this->total[$key] = 0;
        $this->quantity[$key] = 0;

    }

    public function plusRow()
    {

        if (count($this->name) != $this->row) {
            $this->row += 1;
        } else {
            $this->emitSelf("event-plus-row");
        }

    }

    public function minusRow($row)
    {

        $this->resetField($row);

    }

    public function totalUpdate($key)
    {
        if ($this->quantity[$this->row] == '') {
            $this->total[$key] = 0;
            return;
        }
        if (isset($this->total[$this->row])) {
            $this->total[$key] = $this->quantity[$key] * $this->price[$key];
        }
    }

    public function updatedOffer()
    {

        $this->total[$this->this] = 2;

    }

    public function addProduct()
    {

        $this->validate([
            'quantity.*' => 'required|numeric|gt:0',
        ]);
        if (!empty($this->name)) {
            $information = $this->addInformation();
        }
        foreach ($this->name as $key => $name) {
            $storage = \App\Models\Storage::whereName($name)->first();
            $storage->update([
                "quantity" => $storage->quantity - $this->quantity[$key]
            ]);
            $information->sales()->attach($storage->id,
                [
                    "quantity" => $this->quantity[$key],
                    "total" => $this->total[$key],
                    "offer" => $this->offer[$key]
                ]
            );
        }
        $this->resetAllField();
        $this->emitSelf("event-product");
    }

    public function addInformation()
    {
        return Information::create([
            "description" => $this->description,
            "type" => "remove",
            "publish_at" => Carbon::createFromFormat("d/m/Y", $this->date)->format('Y-m-d '),
        ]);

    }

    public function resetAllField()
    {
        $this->name = [];
        $this->price = [];
        $this->description = "";
        $this->date = date("d/m/Y");
        $this->quantity = [];
        $this->total = [];
        $this->offer = [];
        $this->mm = [];
        $this->row = 0;
        $this->key = 0;
        $this->title = 0;
    }

    public function resetField($row)
    {
        unset($this->name[$row]);
        unset($this->total[$row]);
        unset($this->offer[$row]);
        unset($this->price[$row]);
        unset($this->quantity[$row]);
        unset($this->mm[$row]);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {

        $name = empty($this->name[$this->title]) ? '' : $this->name[$this->title];

        return view('livewire.admin.storage.remove-storage', [
            "storages" => \App\Models\Storage::where('name', 'LIKE', '%' . $name . '%')->get(),
        ]);
    }

}