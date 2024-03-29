<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
       <div class="flex justify-between w-full sm:max-w-xl">
                <h1 class="text-black text-lg font-bold">support ticket</h1>
            <div>
                <a href="{{ route('ticket.create') }}" class="bg-white rounded-lg p-2">Create New</a>
            </div>
        </div>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @forelse ($tickets as $ticket)
                <div class="text-black flex justify-between py-4">
                    <a href="{{route('ticket.show' , $ticket->id)}}">{{ $ticket->title }}</a>
                    <p>{{ $ticket->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p>you do not have any support ticket</p>
            @endforelse
        </div>
    </div>
</x-app-layout>