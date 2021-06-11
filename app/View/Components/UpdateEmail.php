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

    public $hospital;

    public function __construct($hospital)
    {
//        $hospitalObj = new Hospital();
//        // Ref: https://commandz.io/post/php/2016-02-21-eloquent-model-json-serialization-and-deserialization/
//        $this->hospital = $hospitalObj->newInstance($hospitalObj->fromJson($hospital));
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
