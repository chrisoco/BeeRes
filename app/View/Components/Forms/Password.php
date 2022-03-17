<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Password extends Component
{
    /**
     * The alert type.
     *
     * @var boolean
     */
    public $confirm;

    /**
     * Create a new component instance.
     *
     * @return void
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
