<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\Component;

class Stats extends Component
{
    #[On('transaction-updated')]
    public function refreshAssets()
    {
        // Metode ini akan dipanggil setiap kali event 'transaction-updated' dipicu
        // Anda dapat menambahkan logika tambahan di sini jika diperlukan
    }
    public function minusAssets()
        {
                sleep(2);
            if($this->getAssets() >= 50000){
                Transaction::create([
                    'type' => 'keluar',
                    'amount' => 50000,
                    'description' => 'Penarikan Cepat'
                ]);
            }
            
            $this->dispatch('transaction-ipdated');
        }
     private function getAssets()
    {
        $Masuk = Transaction::where('type', 'masuk')->sum('amount');
        $Keluar = Transaction::where('type', 'keluar')->sum('amount');

        return $Masuk - $Keluar;
    }
    
    public function render()
    {
        return view('livewire.stats', [
            'asset' => $this->getAssets(),
        ]);
    }
}
