<x-app-layout>
    <div class="grid grid-cols-4 gap-10 mt-6">
        <div class="bg-white shadow-md rounded-lg px-6 py-6">
            <h4 class="text-gray-500 font-medium">Users</h4>
            <div class="text-3xl font-bold mt-4">{{ $usersCount }}</div>
        </div>
        <div class="bg-white shadow-md rounded-lg px-6 py-6">
            <h4 class="text-gray-500 font-medium">Orders</h4>
            <div class="text-3xl font-bold mt-4">{{ $ordersCount }}</div>
        </div>
        <div class="bg-white shadow-md rounded-lg px-6 py-6">
            <h4 class="text-gray-500 font-medium">Revenue</h4>
            <div class="text-3xl font-bold mt-4">{{ (new NumberFormatter('en_US', NumberFormatter::CURRENCY))->formatCurrency($revenue/100, 'USD') }}</div>
        </div>
    </div>

</x-app-layout>
