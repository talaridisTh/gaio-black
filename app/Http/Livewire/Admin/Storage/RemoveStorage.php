<?php

namespace App\Http\Livewire\Admin\Storage;

use Livewire\Component;

class RemoveStorage extends Component {

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.admin.storage.remove-storage');
    }

}