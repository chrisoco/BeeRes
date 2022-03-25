<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Alert extends Component
{

    /**
     * The alert title.
     *
     * @var string
     */
    public $title;

    /**
     * The alert message.
     *
     * @var string
     */
    public $message;

    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $message
     * @param $type
     */
    public function __construct($title, $message, $type)
    {
        $this->title   = $title;
        $this->message = $message;
        $this->type    = $type;
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
