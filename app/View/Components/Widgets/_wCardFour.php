<?php

namespace App\View\Components\Widgets;

use Illuminate\View\Component;

class _wCardFour extends Component
{
    /**
     * The title.
     *
     * @var string
     */
    public $title;
    public $outstandingUserOrders;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $outstandingUserOrders)
    {
        $this->title = $title;
        $this->outstandingUserOrders = $outstandingUserOrders;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widgets._w-card-four');
    }
}
