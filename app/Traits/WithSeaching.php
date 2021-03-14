<?php

namespace App\Traits;
trait WithSeaching {

    public $search = "";

    public function updatingSearch()
    {
        $this->resetPage();
    }

}