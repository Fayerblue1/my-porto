<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Dashboard extends Component
{
    public $name = 'JohnDoe';
   

    #[Validate('required|numeric|min:10000',message:'Minimal top up adalah 10.000')]
    public $amount;

    
    
    public function topUp()
    {
        $this->validate(); // menjalankan  validasi berdasarkan 3[Validate]

        //Simpann ke DATABASE
        Transaction::create([
            'type' => 'masuk',
            'amount' => $this->amount,
            'description' => 'Top Up Kustum'
        ]);

        $this->reset('mount'); // Reset input nominal setelah top up
    }

    public function minusAssets()
        {
            if($this->getAssets() >= 50000){
                Transaction::create([
                    'type' => 'keluar',
                    'amount' => 50000,
                    'description' => 'Penarikan Cepat'
                ]);
            }
        }
    private function getAssets()
    {
        $Masuk = Transaction::where('type', 'masuk')->sum('amount');
        $Keluar = Transaction::where('type', 'keluar')->sum('amount');

        return $Masuk - $Keluar;
    }    
    public function render()
    {
        return view('livewire.dashboard', [   
            'asset' => $this->getAssets(),
            'transactions' => Transaction::count(),
            'history' => Transaction::latest()->take(5)->get(),
            ]);
    }
}
