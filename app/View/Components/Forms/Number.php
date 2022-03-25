<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Number extends Component
{

    /**
     * The input number name.
     *
     * @var string
     */
    public $name;

    /**
     * The input number title.
     *
     * @var string
     */
    public $title;

    /**
     * The input number value.
     *
     * @var float
     */
    public $value;

    /**
     * The input number min value.
     *
     * @var float
     */
    public $min;

    /**
     * The input number max value.
     *
     * @var float
     */
    public $max;

    /**
     * The input number increment steps.
     *
     * @var string
     */
    public $step;

    /**
     * The input number placeholder.
     *
     * @var float
     */
    public $placeholder;

    /**
     * If the input number is required.
     *
     * @var boolean
     */
    public $required;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $title
     * @param $value
     * @param $min
     * @param $max
     * @param $step
     * @param $placeholder
     * @param $required
     */
    public function __construct($name, $title, $value, $min, $max, $step, $placeholder, $required = 'true')
    {
        $this->name        = $name;
        $this->title       = $title;
        $this->value       = $value;
        $this->min         = $min;
        $this->max         = $max;
        $this->step        = $step;
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
