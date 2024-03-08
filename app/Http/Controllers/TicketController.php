<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;

class TicketController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $ticket = Ticket::first();
        $this->authorize('view', $ticket);

        return TicketService::index();
    }

    public function create(TicketRequest $request)
    {
        $this->authorize('create', Ticket::class);

        return TicketService::create($request);
    }

    public function update(int $id, TicketRequest $request)
    {
        $this->authorize('update', Ticket::class);

        return TicketService::update($id, $request);
    }

    public function destroy($id)
    {
        $this->authorize('delete', Ticket::class);

        return TicketService::delete($id);
    }
}
