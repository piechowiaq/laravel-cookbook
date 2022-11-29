<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChartOrders extends Component
{
    public function render()
    {
        $availableYears = [
          date('Y'), date('Y') -1, date('Y') -2, date('Y')-3,
        ];
        return view('livewire.chart-orders', [
            'availableYears' => $availableYears
        ]);
    }
}
