<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeacherForm extends Component
{
    /**
     * Create a new component instance.
     */

    public $action;
    public $buttonText;
    public $method;
    public $teacher;

    public function __construct($action, $buttonText = 'Submit', $method = '', $teacher = null)
    {
        $this->action = $action;
        $this->buttonText = $buttonText;
        $this->method = $method;
        $this->teacher = $teacher;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.teacher-form');
    }
}
