<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChangePassword extends Component
{
    public $id;
    public $user_type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $userType)
    {
        $this->id = $id;
        $this->user_type = $userType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.change-password');
    }
}
