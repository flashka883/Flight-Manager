<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Ticket;
use Slim\Http\Response;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use App\Models\ReservedTicket;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\ReservedTicketsNoneUsers;

class CheckoutController extends Controller
{

    public function checkout(Ticket $ticket, $reservedTicket, $guest = null)
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

        if ($guest) {
            $reservedTicket = ReservedTicketsNoneUsers::where('id', $reservedTicket)->first();
        } else {
            $reservedTicket = ReservedTicket::where('id', $reservedTicket)->first();
        }

        return view('checkout', compact('ticket', 'reservedTicket', 'guest'));
    }

    public function postCheckout(Request $request, Ticket $ticket, $reservedTicket, $guest = null)
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

        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create([
            "amount" => $ticket->price * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment"
        ]);

        Session::flash('success', 'Payment successful!');

        if ($guest) {
            $reservedTicket = ReservedTicketsNoneUsers::where('id', $reservedTicket)->first();

            $reservedTicket->is_paid = true;
            $reservedTicket->save();
        } else {
            $reservedTicket = ReservedTicket::where('id', $reservedTicket)->first();

            $reservedTicket->is_paid = true;
            $reservedTicket->save();
        }

        $takenSeats = ReservedTicket::where('ticket_id', $ticket->id)->count();
        $takenSeats += ReservedTicketsNoneUsers::where('ticket_id', $ticket->id)->count();

        $details = [
            'title' => 'Mail from Flight Manager',
            'body' => 'You have successfully booked your ticket. There are ' . ((int) $ticket->classSeats - (int) $takenSeats) . ' left seats on the plane.'
        ];

        Mail::to('your_receiver_email@gmail.com')->send(new InvoiceMail($details));

        return redirect(route('home'));
    }
}
