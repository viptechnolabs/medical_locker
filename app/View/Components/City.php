<?php

namespace App\View\Components;

use Illuminate\View\Component;

class City extends Component
{
    public $cities;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selected = null)
    {
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
//        dd($this->selectCity);
        return view('components.city');
    }
}
