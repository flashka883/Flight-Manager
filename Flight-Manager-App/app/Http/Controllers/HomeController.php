<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cities = DB::table('cities')
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            ->select(
                'cities.name as cityName',
                'countries.name as countryName'
            )->get();

        $cityFrom = $request->get('city_from');
        $cityTo = $request->get('city_to');

        $tickets = Ticket::join('air_plane_classes', 'tickets.air_plane_class_id', '=', 'air_plane_classes.id')
            ->join('air_ports as apf', 'tickets.air_port_from', '=', 'apf.id')
            ->join('air_ports as apt', 'tickets.air_port_to', '=', 'apt.id')
            ->join('cities as cf', 'apf.city_id', '=', 'cf.id')
            ->join('cities as ct', 'apt.city_id', '=', 'ct.id')
            ->select(
                'tickets.id as id',
                'tickets.departs_at as departs_at',
                'tickets.lands_at as lands_at',
                'air_plane_classes.name as className',
                'apf.name as airPortFromName',
                'apt.name as airPortToName',
                'cf.name as cityFrom',
                'ct.name as cityTo',
                'tickets.price'
            )
            ->when(!is_null($cityFrom), function ($query) use ($cityFrom) {
                return $query->where('cf.name', $cityFrom);
            })
            ->when(!is_null($cityTo), function ($query) use ($cityTo) {
                return $query->where('ct.name', $cityTo);
            })
            ->whereDate('departs_at', '>', Carbon::now())
            ->paginate(4);

        return view('index', compact('cities', 'tickets', 'cityFrom', 'cityTo'));
    }
}
