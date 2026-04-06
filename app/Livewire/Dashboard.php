<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $name = 'JohnDoe';
    public $aset = 1500000;
    public $transactioncount = 0;

    public function render()
    {
        return view('livewire.dashboard');
    }
}
