<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert message.
     *
     * @var string
     */
    public $message;

    /**
     * The alert message.
     *
     * @var boolean
     */
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, $type)
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.alert');
    }
}
