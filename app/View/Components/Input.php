<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\View\View;

class Input extends Component {

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public $id;
    public $value;
    public $feather;
    public $text;
    public $type;
    public $user;

    public function __construct($id, $value, $user = null, $feather = null, $text = null, $type = "text")
    {

        $this->id = $id;
        $this->value = $value;
        $this->text = $text;
        $this->feather = $feather;
        $this->type = $type;
        $this->user = $user;

    }

    public function render()
    {
        return view('components.input');
    }

}