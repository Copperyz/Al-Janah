<?php

namespace App\Livewire;

use Livewire\Component;

class TemplateCard extends Component
{
    public $header = true;
    public $footer = true;
    public $headerOnEveryPage = false;
    public $onHover = true;
    
    public function render()
    {
        return view('livewire.template-card');
    }
}
