<?php

namespace App\Http\Livewire\Admin\Information;

use App\Traits\WithSeaching;
use App\Traits\WithSorting;
use App\Models\Information as InformationAlias;
use Livewire\Component;
use Livewire\WithPagination;

class Sales extends Component {

    use WithPagination, WithSorting, WithSeaching;

    public $sortBy = "id";
    public $startDate;
    public $endDate;
    public $info;
    public $entries = 10;
    public $queryString = [
        'search' => ['except' => ''],
    ];


    public function mount()
    {
        $this->info = new InformationAlias;
        $this->sortDirection="desc";

        if ($this->info->all()->isNotEmpty()) {
            $this->startDate = $this->info->orderBy('publish_at', 'asc')->first()->publish_at;
            $this->endDate = $this->info->orderBy('publish_at', 'desc')->first()->publish_at;
        }
    }


    

    public function resetDate()
    {
        $this->mount();
    }

    public function render()
    {

        return view('livewire.admin.information.sales', [
            "information" => $this->info->storageRemove()->with("storages")->orderBy($this->sortBy, $this->sortDirection)
                ->whereBetween('publish_at', [$this->startDate, $this->endDate])
                ->paginate($this->entries)
        ]);
    }
}