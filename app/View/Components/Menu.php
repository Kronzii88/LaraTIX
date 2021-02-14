<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    
    public $active;
    public function __construct($active)
    {
        //
       
        $this-> active = $active;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu', ['active' => $this -> active]);
    }
    //function dari component dapat langsung di access oleh viewnya tanpa harus dimasukkan ke dalam method render. hanya terjadi di bagian component saja
    public function list() {
        return [
            ['label' => 'Dashboard'],
            ['label' => 'Movies'],
            ['label' => 'Theathers'],
            ['label' => 'Tickets'],
            ['label' => 'Users']
        ];
    }
    public function isActive($label) {
        return $label === $this -> active;
    }
}
