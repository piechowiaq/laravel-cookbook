<x-app-layout>
    <div class="bg-white rounded-md border my-8 px-6 py-6 mx-40">
        <div>
            <h2 class="text-2xl font-semibold">Charts</h2>
            <div class="m-6">
                <div>Last Year Orders: {{ array_sum($lastYearOrders) }}</div>
                <div>This Year Orders: {{ array_sum($thisYearOrders) }}</div>
            </div>
                <livewire:chart-orders/>
        </div>
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan',
                                 'Feb',
                                 'Mar',
                                 'Apr',
                                 'May',
                                 'Jun',
                                 'Jul',
                                 'Aug',
                                 'Sep',
                                 'Oct',
                                 'Nov',
                                 'Dec',
                               ],
                        datasets: [{
                            label: 'Last Year Orders',
                            data: {{Js::from($lastYearOrders)}},
                            borderWidth: 1},
                                    {
                            label: 'This Year Orders',
                            data: {{ Js::from($thisYearOrders) }},
                            borderWidth: 1
                            }]},
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endpush
    </div>
</x-app-layout>
