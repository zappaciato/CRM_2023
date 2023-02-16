<?php

namespace App\View\Components\Menu;

use App\Models\Email;
use App\Models\Order;
use Illuminate\View\Component;

class verticalMenu extends Component
{


    // public $emails;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->emails = $emails;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // $emails = Email::where('emailstatus', '!=', 'assigned')->sortByDesc('created_at');
        // $orders = Order::all();
        // $ordersCount = count(Order::all());
        return view('components.menu.vertical-menu');
    }
}
