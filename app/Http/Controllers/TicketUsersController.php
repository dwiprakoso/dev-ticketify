<?php

namespace App\Http\Controllers;

use App\Models\TicketUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tickets_user = TicketUsers::with('event')
            ->where('users_email', $user->email)
            ->get();

        if ($tickets_user->isEmpty()) {
            return view('landing.pages.ticket.index')->with('message', 'Oops kamu tidak memiliki tiket');
        }

        return view('landing.pages.ticket.index', compact('tickets_user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketUsers $ticketUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketUsers $ticketUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketUsers $ticketUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketUsers $ticketUsers)
    {
        //
    }
}
