<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Password extends Component
{
    /**
     * If the password needs to be confirmed.
     *
     * @var boolean
     */
    public $confirm;

    /**
     * Create a new component instance.
     *
     * @param $confirm
     */
    public function __construct($confirm)
    {
        $this->confirm = $confirm == 'true';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.password');
    }
}
