<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class CreateUser extends Component {

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public $users;
    public $email;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function mount()
    {
        $this->users = User::pluck("first_name");
    }

    public function submit()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.user.create-user');
    }

}