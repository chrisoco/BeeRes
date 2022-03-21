<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Number extends Component
{

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
     * @var string
     */
    public $min;

    /**
     * The alert message.
     *
     * @var string
     */
    public $max;

    /**
     * The alert message.
     *
     * @var string
     */
    public $step;

    /**
     * The alert message.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The alert message.
     *
     * @var boolean
     */
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $value, $min, $max, $step, $placeholder, $required = 'true')
    {
        $this->name  = $name;
        $this->title = $title;
        $this->value = $value;
        $this->min   = $min;
        $this->max   = $max;
        $this->step  = $step;
        $this->placeholder = $placeholder;
        $this->required    = $required == 'true';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.number');
    }
}
