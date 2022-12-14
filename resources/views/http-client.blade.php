<x-app-layout>
    <div class="bg-white rounded-md border my-8 px-6 py-6">
        <div>
            @if (session('success_message'))
                <div class="bg-green-200 text-green-800 px-4 py-2 my-2">
                    {{ session('success_message') }}
                </div>
            @endif
            <h2 class="text-2xl font-semibold">HTTP Client</h2>
            <div class="mt-4">
                <h3 class="text-xl font-semibold">Repos form API</h3>
                <ul class="list-disc ml-4 mt-4">
                    @forelse ($repos as $repo)
                        <li>{{ $repo['name'] }}</li>
                    @empty
                        <li>No repos found</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
