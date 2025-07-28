<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClassForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $students;
    public $teachers;
    public $selectedTeacher;
    public $method;
    public $action;
    public $class;
    public function __construct($action, $selectedTeacher = null ,$students = null, $teachers = null, $method = 'POST', $class=null)
    {
        $this->students = $students;
        $this->teachers = $teachers;
        $this->selectedTeacher = (array) $selectedTeacher;
        $this->method = $method;
        $this->action = $action;
        $this->class = $class;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.class-form');
    }
}
