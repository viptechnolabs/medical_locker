<?php

namespace App\View\Components;

use Illuminate\View\Component;

class City extends Component
{
    public $cities;
    public $selectCity;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selectCity)
    {
        $this->selectCity = $selectCity;
        $this->cities = \App\Models\City::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.city');
    }
}
