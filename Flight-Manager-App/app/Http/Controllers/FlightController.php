<?php

namespace App\Http\Controllers;

use App\Models\ReservedTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\ReservedTicketsNoneUsers;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    public function getTicket(Ticket $ticket)
    {

        $ticket = $ticket
            ->join('air_plane_classes', 'tickets.air_plane_class_id', '=', 'air_plane_classes.id')
            ->join('air_ports as apf', 'tickets.air_port_from', '=', 'apf.id')
            ->join('air_ports as apt', 'tickets.air_port_to', '=', 'apt.id')
            ->join('cities as cf', 'apf.city_id', '=', 'cf.id')
            ->join('cities as ct', 'apt.city_id', '=', 'ct.id')
            ->select(
                'tickets.id as id',
                'tickets.departs_at as departs_at',
                'tickets.lands_at as lands_at',
                'air_plane_classes.name as className',
                'air_plane_classes.seats as classSeats',
                'apf.name as airPortFromName',
                'apt.name as airPortToName',
                'cf.name as cityFrom',
                'ct.name as cityTo',
                'tickets.price'
            )->first();



        return view('book-summary', compact('ticket'));
    }

    public function reserveTicket(Request $request)
    {
        # code...
    }

    public function reserveTicketNoneUser(Request $request, Ticket $ticket)
    {
        $ticket = $ticket
            ->join('air_plane_classes', 'tickets.air_plane_class_id', '=', 'air_plane_classes.id')
            ->join('air_ports as apf', 'tickets.air_port_from', '=', 'apf.id')
            ->join('air_ports as apt', 'tickets.air_port_to', '=', 'apt.id')
            ->join('cities as cf', 'apf.city_id', '=', 'cf.id')
            ->join('cities as ct', 'apt.city_id', '=', 'ct.id')
            ->select(
                'tickets.id as id',
                'tickets.departs_at as departs_at',
                'tickets.lands_at as lands_at',
                'air_plane_classes.name as className',
                'air_plane_classes.seats as classSeats',
                'apf.name as airPortFromName',
                'apt.name as airPortToName',
                'cf.name as cityFrom',
                'ct.name as cityTo',
                'tickets.price'
            )->first();

        $takenSeats = ReservedTicket::where('ticket_id', $ticket->id)->count();
        $takenSeats += ReservedTicketsNoneUsers::where('ticket_id', $ticket->id)->count();

        if ($ticket->classSeats - $takenSeats <= 0) {
            return back()->withErrors(['msg' => 'All seats are taken.']);
        }

        $rules = [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'egn' => 'required',
            'phone' => 'required',
            'nationality' => 'required',
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag());
        }

        $data = $request->except('_token');
        $data['ticket_id'] = $ticket->id;

        $reservedTicket = ReservedTicketsNoneUsers::create($data);

        return redirect(
            route(
                'ticket.checkout',
                ['ticket' => $ticket->id, 'reservedTicket' => $reservedTicket->id, 'guest' => true]
            )
        )->with(['reservedTicket' => $reservedTicket->id]);
    }
}
