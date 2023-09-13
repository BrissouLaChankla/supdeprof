<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Role;


class Datatable extends Component
{
    /**
     * Create a new component instance.
     */

     public $role;
     public $name;

    public function __construct($role, $name)
    {
        
        $this->role = $role;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datatable');
    }
}
