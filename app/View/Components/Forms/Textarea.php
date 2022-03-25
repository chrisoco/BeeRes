<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * The textarea name.
     *
     * @var string
     */
    public $name;

    /**
     * The textarea title.
     *
     * @var string
     */
    public $title;

    /**
     * The textarea value.
     *
     * @var string
     */
    public $value;

    /**
     * If the textarea is required.
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
     * @param $required
     */
    public function __construct($name, $title, $value, $required = 'true')
    {
        $this->name     = $name;
        $this->title    = $title;
        $this->value    = $value;
        $this->required = $required == 'true';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.textarea');
    }
}
