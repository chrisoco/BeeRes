<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * The input type.
     *
     * @var string
     */
    public $type;

    /**
     * The input name.
     *
     * @var string
     */
    public $name;

    /**
     * The input title.
     *
     * @var string
     */
    public $title;

    /**
     * The input value.
     *
     * @var string
     */
    public $value;

    /**
     * If the input is required.
     *
     * @var boolean
     */
    public $required;

    /**
     * The input placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param $type
     * @param $name
     * @param $title
     * @param $value
     * @param $required
     * @param $placeholder
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
