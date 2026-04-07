<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $name = 'JohnDoe';
    public $aset = 1500000;
    public $transactioncount = 0;


    public function plusAssets()
    {
        $this->aset += 500000; //Tambah aset sebesar 500.000
        $this->transactioncount++; //Tambah jumlah transaksi sebanyak 1
    }
    public function minusAssets()
    {
       if ($this->aset >= 500000) { // Pastikan aset tidak menjadi negatif
            $this->aset -= 500000; // Kurangi aset sebesar 500.000
            $this->transactioncount++; // Tambah jumlah transaksi sebanyak 1
        }
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
