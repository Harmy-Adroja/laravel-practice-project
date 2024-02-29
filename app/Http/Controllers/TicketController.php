<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Comments;
use App\Notifications\TicketUpdatedNotification;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\str;

use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user    = auth()->user();
        $tickets = $user->isAdmin ? Ticket::latest()->get() : $user->tickets;
        
        return view ('ticket.index',compact('tickets'));
       
    }

    /**
     * Show the form for creating a new r',['esource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title'       => $request->title,
            'discription' => $request->discription,
            'user_id'     => auth()->id(),
        ]);

        if($request->file('attachment')){
            $this->storeAttachment($request,$ticket);
                }
                return redirect(route('ticket.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $ticket->load('comments.user');
        return view ('ticket.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view ('ticket.edit',compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->except('attachment'));

        if($request->has('status')){
                //$user = User::find($ticket->user_id);
                $ticket->user->notify(new TicketUpdatedNotification($ticket));
        }

        if($request->file('attachment')){
            Storage::disk('public')->delete($ticket->attechment);
            $this->storeAttachment($request,$ticket);
        }
               

        return redirect(route('ticket.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }
    protected function storeAttachment($request,$ticket)
    {
        $ext=$request->file('attachment')->extension();
            $contents=file_get_contents($request->file('attachment'));
            $filename=Str::random(25);
            $path="attachments/$filename.$ext";
            Storage::disk('public')->put($path,$contents);
            $ticket->update(['attachment'=>$path]);
    }
}
