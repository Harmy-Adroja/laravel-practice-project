<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-black text-lg font-bold">{{ $ticket->title }}</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="text-black flex justify-between py-4">
                    <p>{{ $ticket->discription}}</p>
                    <p>{{ $ticket->created_at->diffForHumans() }}</p>
                @if ($ticket->attachment)
                    <a href="{{ '/storage/' . $ticket->attachment }}" target="_blank">Attachment</a>
                @endif
            </div>
            <div class="flex justify-between">
                <div class="flex">
                    <a href="{{route('ticket.edit',$ticket->id)}}">
                    <x-button>edit</x-button>
                    </a>
                    <form class="ml-2" action="{{ route('ticket.destroy', $ticket->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <x-button>Delete</x-button>
                    </form>
                </div>
                
                @if (auth()->user()->isAdmin)
                    <div class="flex" >
                        <form action="{{route('ticket.update',$ticket->id)}}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="resolved" />
                            <x-button>resolved</x-button>
                        </form>
                        <form action="{{route('ticket.update',$ticket->id)}}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="rejected" />
                            <x-button class="ml-2">reject</x-button>
                        </form>
                            
                @else
                    <p>status: {{$ticket->status}} </p>
                @endif
                </div>
            </div>
            
            
            <!-- Display ticket details -->
            <!-- @foreach ($ticket->comments as $comment)
                     <div>
                        <strong>{{ $comment->user->name }}</strong> said:
                        <p>{{ $comment->comments }}</p>
                        </div>
                @endforeach -->
                    
                    
                <div class="mt-4">
                    <form method="post" action="{{ route('ticket.comments.store', $ticket->id) }}">
                        @csrf
                        <x-label for="comments">Your Comment:</x-label>
                        <x-textarea placeholder="Add message" name="comments" id="comments" value="" />
                        <x-button class="mt-4"   type="submit">Add Comment</x-button>
                        
                    </form>

                <x-button class="mt-4" id="showComments">Show Comments</x-button>
                <div id="commentsContainer" style="display: none;">
                <h2>Comments</h2>

                @foreach ($ticket->comments as $comment)
                    <div>
                        <strong>{{ $comment->user->name }}</strong> said:
                        <p>{{ $comment->comments }}</p>
                    </div>
                @endforeach

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                $(document).ready(function() {
                // Show/hide comments when clicking on the button
                $('#showComments').on('click', function() {
                $('#commentsContainer').toggle();
                });
                });
                </script>
                    </div>
               
            </div>
        </div>
    </div>
</x-app-layout>