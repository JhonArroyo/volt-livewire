<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Finance;

new class extends Component {
    use WithPagination;

    public $display2;

    #[On('searchTermUpdated')]
    public function propertyGathered($searchTerm)
    {
        return $this->display2 = $searchTerm;
    }

    public function with():array
    {
        return
        [
            'display' => Finance::where('f.actual_year', $this->display2)->paginate(4),
        ];
    }

}; ?>

<div>
    <h2>{{ _('Data: ') . $display2 }}</h2>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Test-second-component-a
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Test2-second-component-b
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($display as $d)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" wire:key='{{ $d->id }}'>
                    <td class="px-6 py-4">
                        {{ $d->value }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $d->industry_code_anzsic06 }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $display->links() }}
    </div>
</div>


