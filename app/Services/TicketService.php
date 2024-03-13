<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    public static function index()
    {
        $user = auth()->user();
        switch ($user->role) {
            case 'manager':
                $tickets = Ticket::with('userticket', 'branch')->where(function ($query) use ($user) {
                    $query->whereIn('status', ['in_progress', 'approved','reject'])
                        ->where('branch_id', $user->branch_id);
                })->get();

                return response()->json(['tickets' => $tickets]);
                break;
            case 'user':
                $tickets = Ticket::where('created_by', $user->id)->get();

                return response()->json(['tickets' => $tickets]);
                break;
                     case 'user':
                $tickets = Ticket::where('created_by', $user->id)->get();

                return response()->json(['tickets' => $tickets]);
                break;
                case 'itdesk':
                    $tickets = Ticket::with('userticket', 'branch')->where(function ($query) use ($user) {
                        $query->whereIn('status', ['approved']);
                    })->get();
    
                    return response()->json(['tickets' => $tickets]);
                    break;
            default:
               
                break;
        }
    }

    public static function create($request)
    {
        try {
            $ticket = Ticket::create($request->validated());

            return response()->json(['message' => $ticket->subject.' created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 500]);
        }
    }

    public static function update($id, $request)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            //Some Validation needed
            $ticket->update($request->validated());

            return response()->json(['message' => $ticket->subject.' updated successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 500]);
        }
    }

    public static function delete($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();

            return response()->json(['message' => $ticket->subject.' deleted successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 500]);
        }
    }
}
