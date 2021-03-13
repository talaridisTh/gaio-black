<?php

namespace App\Http\Livewire\Admin\Storage;

use App\Models\Storage;
use App\Traits\WithSeaching;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ShowStorage extends Component {

    use WithPagination, WithSorting ,WithSeaching;

    public $sortBy = "name";
    public $entries = 10;
    public $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        return view('livewire.admin.storage.show-storage',[
            "storage" => Storage::where('name', 'LIKE', '%' . $this->search . '%')->orderBy($this->sortBy, $this->sortDirection)->paginate($this->entries)
        ]);
    }

}