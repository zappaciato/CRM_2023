<?php

namespace App\View\Components\Menu;

use App\Models\Order;
use Illuminate\View\Component;

class verticalMenu extends Component
{


    // public $ordersCount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    // public function __construct($ordersCount)
    // {
    //     $this->ordersCount = $ordersCount;
    // }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // $orders = Order::all();
        // $ordersCount = count(Order::all());
        return view('components.menu.vertical-menu');
    }
}
