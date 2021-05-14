<?php

namespace App\View\Components;

use App\Models\Hospital;
use Illuminate\View\Component;

class UpdateEmail extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;
    public $email;

    public function __construct($id)
    {
        $hospital = Hospital::findOrFail($id);
        $this->email = $hospital->email;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.update-email');
    }
}
