<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Dashboard extends Component
{
    public $name = 'JohnDoe';
    public $aset = 1500000;
    public $transactioncount = 0;

    #[Validate('required|numeric|min:10000',message:'Minimal top up adalah 10.000')]
    public $nominal;

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
    public function topUp()
    {
        $this->validate(); // menjalankan  validasi berdasarkan 3[Validate]

        $this->aset += $this->nominal; // Tambah aset dengan nominal yang diinput
        $this->transactioncount++; // Tambah jumlah transaksi sebanyak 1

        $this->reset('nominal'); // Reset input nominal setelah top up
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
