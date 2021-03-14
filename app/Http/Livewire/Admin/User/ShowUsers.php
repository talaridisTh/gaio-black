<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use App\Traits\WithSeaching;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component {

    use WithPagination, WithSorting, WithSeaching;

    public $sortBy = "first_name";
    public $entries = 10;
    public $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        return view('livewire.admin.user.show-users', [
            "users" => User::where('first_name', 'LIKE', '%' . $this->search . '%')->orderBy($this->sortBy, $this->sortDirection)->paginate($this->entries)
        ]);
    }

}
