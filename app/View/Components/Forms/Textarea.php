<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $name;

    /**
     * The alert type.
     *
     * @var string
     */
    public $title;

    /**
     * The alert type.
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
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $value, $required = 'true')
    {
        $this->name  = $name;
        $this->title = $title;
        $this->value = $value;
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
