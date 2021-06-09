<?php

namespace App\View\Components;

use App\Models\Doctor;
use Illuminate\View\Component;

class DoctorStatus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    //public $id;

    public function __construct()
    {
        //
        //$doctor = Doctor::findOrFail($id);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.doctor-status');
    }
}
