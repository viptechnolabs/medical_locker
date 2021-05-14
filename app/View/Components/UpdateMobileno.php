<?php

namespace App\View\Components;

use App\Models\Hospital;
use Illuminate\View\Component;

class UpdateMobileno extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;
    public $mobile_no;

    public function __construct($id)
    {
        $hospital = Hospital::findOrFail($id);
        $this->mobile_no = $hospital->mobile_no;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.update-mobileno');
    }
}
