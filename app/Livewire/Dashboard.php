<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Dashboard extends Component
{
    public $name = 'JohnDoe';
    public $search = '';

    #[Validate('required|numeric|min:10000',message:'Minimal top up adalah 10.000')]
    public $amount;

    #[On('transaction-updated')]
    public function refreshAssets() {}

    public function topUp()
    {
        $this->validate(); // menjalankan  validasi berdasarkan 3[Validate]


        sleep(2);
        //Simpann ke DATABASE
        Transaction::create([
            'type' => 'masuk',
            'amount' => $this->amount,
            'description' => 'Top Up Kustum'
        ]);

        $this->reset('amount'); // Reset input nominal setelah top up

        $this->dispatch('transaction-ipdated');
    }

    
    
    public function delete($id)
    {
        $Transaction = Transaction::findOrFail($id);
        $Transaction->delete();

        $this->dispatch('transaction-ipdated');
    }
    public function render()
    {
        $history = Transaction::query()
         -> when($this->search, function($query){
            $query->where('description', 'like', '%'.$this->search .'%');

         })->latest()->get();
        return view('livewire.dashboard', [   
            'transactions' => Transaction::count(),
            'history' => $history,
            ]);
    }
}
