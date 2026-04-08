<div>
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-10">
        <div class="h-16 w-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
            <span class="text-2xl font-bold font-mono">
                {{substr($name, 0, 1)}}
            </span>
        </div>
        <div class="mt-4">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">
                Selamat Datang,<span class="text-indigo-600"> {{$name}}</span>
            </h1>
            <p class="text-slate-400 mt-1 font-medium italic">Ubah Profilemu Secara real-time disini</p>
        </div>
    </div>
    <div class="flex flex-col gap-2 mt-5 mx-4">
        <label class="text-xl font-bold text-slate-600 uppercase tracking-widest" for="name">Ganti nama</label>
        <input type="text" id="name" wire:model.live="name" class="px-4 py-2 rounded-xl border-2 border-slate-100 focus:border-indigo-500 focus:ring-0 outline-none transition-all text-slite-700 font-medium" placeholder="Masukkan nama baru">
    </div>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-8 bg-slate-50 rounded-2xl border border-slate-300 transition-hover hover:border-indigo-700">
            <p class="text-slate-400 text-xl font-bold uppercase tracking-widest">Total Aset</p>
            <p class="text-3xl font-black text-slate-800 mt-2">Rp {{ number_format($aset, 0, ',', '.') }}</p>

            <button wire:click="minusAssest" class="mt-4 w-full bg-white border-2 border-red-200 text-red-500 py-2 rounded-lg font-bold hover-bg-red-50 transition-all"></button>

        </div>

        <div class="p-8 bg-indigo-600 rounded-2xl border border-indigo-500 text-white shadow-xl shadow-indigo-200">
            <p class="text-indigo-100 text-xl font-bold uppercase tracking-widest text-opacity-70">Progress Pelajaran</p>
            <p class="text-3xl font-black mt-2">Bab 5 :Database Integretion </p>
        </div>
    </div>

    <div class="mt-12 p-10 bg-slate-900 rounded-3xl text-white shadow-2xl">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
             ⚡ Top up Kustom
        </h2>
        <form wire:submit='topUp' class="flex  flex-col md:flex-row gap-6 items-end">
            <input
             type="number"
             wire:model="amount" 
             class="bg-slate-800 border-none rounded-xl px-6 py-4 text-xl font-bold text-indigo-300 focus:ring-2 focus:indigo-500 outline-none transition-all placehorder:text-slite-700" 
             placeholder="Minimal top up 10.000">
             
             <button 
             wire:loading.attr="disabled"
             type="submit"
             class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-500 px-10 py-4 rounded-xl font-black uppercase tracking-widest shadow-lg shadow-indigo-900/50 transition-all active:scale-95 disable:opacity-50%">
             Top Up
            </button>

            @error('nominal')
                <span class="text-red-400 text-xs font-bold mt-1 tracking-tight"> ⚠️{{ $message }}</span>
            @enderror

        </form>
    </div>
    <div class="mt-12">
        <h2 class="text-xl font-bold textt-slite-800 mb-6 flex items-center gap-2">📝 Histori Transaksi</h2>
        <div class="hoverflow-hidden rounded-xl border border-slate-200 ">
            <table class="w-full tex-left border-collapse">
                <thead class="bg-slite-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">waktu</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Tipe</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divede-y divide-slate-50">
                        @forelse ($history as $item)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-4 text-slate-500 text-sx font-medium">{{ $item->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-bold {{$item->type == 'masuk' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}}">{{strtoupper($item -> type)}}</span>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-700">
                                    {{ $item->type == 'masuk' ? '+' : '-' }}Rp {{ number_format($item->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-slate-400 italic">Tidak ada transaksi</td>
                            </tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
