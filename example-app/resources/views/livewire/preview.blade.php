<?php

ini_set('max_execution_time', -1); // TODO 180s(min) - 540s (max) Optimize Performance

use Rap2hpoutre\FastExcel\FastExcel;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Finance;
use App\Models\Mlb;

new class extends Component {
    use WithPagination;

    public $searchTerm;

    public function with():array
    {
        $this->dispatch('searchTermUpdated', $this->searchTerm);
        return
        [
            'display' => Finance::where(function($query){
                $query->where('f.actual_year', 'like', '%' . $this->searchTerm . '%');
            })->paginate(2),
        ];


    }

    public function erase() {
        $filepath = public_path('test.xlsx');
        if (file_exists($filepath)) {
            unlink($filepath);
        }
        else { return redirect('preview');}
    }

    public function export(Finance $finance){
        $collection = $finance->all();
        (new FastExcel($collection))->export('test.xlsx');
        return response()->download(public_path('test.xlsx'));
    }

};
?>

<div>
    <div class="relative overflow-x-auto">
        <div class="py-6">
            <input wire:model.live.debounce.2000ms="searchTerm" type="search" id="default-search" class="p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="test">
            <button class="bg-white rounded-lg text-zinc-950 px-4" wire:click="export">Export</button>
            <button class="bg-white rounded-lg text-zinc-950 px-4" wire:click="erase">Wipe Files</button>
        </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Test
                </th>
                <th scope="col" class="px-6 py-3">
                    Test2
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($display as $d)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" wire:key='{{ $d->id }}'>
                <td class="px-6 py-4">
                    {{ $d->actual_year }}
                </td>
                <td class="px-6 py-4">
                    {{ $d->variable_code }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $display->links() }}
    </div>
</div>


