<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert message.
     *
     * @var string
     */
    public $name;

    /**
     * The alert message.
     *
     * @var string
     */
    public $title;

    /**
     * The alert message.
     *
     * @var string
     */
    public $value;

    /**
     * The alert message.
     *
     * @var boolean
     */
    public $required;

    /**
     * The alert message.
     *
     * @var string
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $title, $value, $required = 'true', $placeholder = '')
    {
        $this->type  = $type;
        $this->name  = $name;
        $this->title = $title;
        $this->value = $value;
        $this->required = $required == 'true';
        $this->placeholder = $placeholder == '' ? $title : $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
