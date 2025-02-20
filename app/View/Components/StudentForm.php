<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StudentForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $action;
    public $method;
    public $student;


    public function __construct($action, $method = 'POST', $student = null)
    {
        $this->action = $action;
        $this->method = $method;
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.student-form');
    }
}
