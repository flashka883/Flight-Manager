<?php

namespace Database\Seeders;

use DateTime;
use Carbon\Carbon;
use App\Models\City;
use App\Models\AirPort;
use App\Models\Country;
use App\Models\AirPlane;
use App\Models\AirPlaneClass;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['name' => 'France'],
            ['name' => 'Cuba'],
            ['name' => 'Canada'],
            ['name' => 'Brazil'],
            ['name' => 'Australia']
        ];
        $cities = [
            ['name' => 'Paris', 'country_id' => 1],
            ['name' => 'Marseille', 'country_id' => 1],
            ['name' => 'Havana', 'country_id' => 2],
            ['name' => 'Santiago de Cuba', 'country_id' => 2],
            ['name' => 'Ottawa', 'country_id' => 3],
            ['name' => 'São Paulo', 'country_id' => 4],
            ['name' => 'Rio de Janeiro', 'country_id' => 4],
            ['name' => 'Sydney', 'country_id' => 5],
            ['name' => 'Melbourne', 'country_id' => 5],
            ['name' => 'Brisbane', 'country_id' => 5],
        ];
        $airPorts = [
            ['name' => 'Paris Airport (CDG) ', 'city_id' => 1],
            ['name' => 'Aéroport Marseille Provence', 'city_id' => 2],
            ['name' => 'José Martí International Airport', 'city_id' => 3],
            ['name' => 'Santiago de Cuba Airport SCU', 'city_id' => 4],
            ['name' => 'Ottawa International Airport (YOW)', 'city_id' => 5],
            ['name' => 'São Paulo/Guarulhos International Airport', 'city_id' => 6],
            ['name' => 'Rio de Janeiro/Galeão International Airport', 'city_id' => 7],
            ['name' => 'Sydney Airport DOM T2', 'city_id' => 8],
            ['name' => 'Melbourne Airport', 'city_id' => 9],
            ['name' => 'Brisbane Airport (BNE)', 'city_id' => 10],
        ];
        $airPlanes = [
            ['name' => 'Airbus A220', 'passengers' => 210],
            ['name' => 'Airbus A320', 'passengers' => 149],
            ['name' => 'Antonov An-148/An-158', 'passengers' => 307],
            ['name' => 'Boeing 747', 'passengers' => 189],
            ['name' => 'Embraer E-Jet E2 family', 'passengers' => 122],
            ['name' => 'Sukhoi Superjet SSJ100', 'passengers' => 96]
        ];
        $airPlaneClasses = [
            ['name' => 'Economy', 'air_plane_id' => 1, 'seats' => 160],
            ['name' => 'Business', 'air_plane_id' => 1, 'seats' => 40],
            ['name' => 'First Class', 'air_plane_id' => 1, 'seats' => 10],
            ['name' => 'Economy', 'air_plane_id' => 2, 'seats' => 120],
            ['name' => 'Business', 'air_plane_id' => 2, 'seats' => 20],
            ['name' => 'First Class', 'air_plane_id' => 2, 'seats' => 9],
            ['name' => 'Economy', 'air_plane_id' => 3, 'seats' => 240],
            ['name' => 'Business', 'air_plane_id' => 3, 'seats' => 40],
            ['name' => 'First Class', 'air_plane_id' => 3, 'seats' => 27],
            ['name' => 'Economy', 'air_plane_id' => 4, 'seats' => 145],
            ['name' => 'Business', 'air_plane_id' => 4, 'seats' => 25],
            ['name' => 'First Class', 'air_plane_id' => 4, 'seats' => 19],
            ['name' => 'Economy', 'air_plane_id' => 5, 'seats' => 100],
            ['name' => 'Business', 'air_plane_id' => 5, 'seats' => 20],
            ['name' => 'First Class', 'air_plane_id' => 5, 'seats' => 2],
            ['name' => 'Economy', 'air_plane_id' => 6, 'seats' => 70],
            ['name' => 'Business', 'air_plane_id' => 6, 'seats' => 20],
            ['name' => 'First Class', 'air_plane_id' => 6, 'seats' => 6],
        ];
        $tickets = [
            ['air_port_from' => 1, 'air_port_to' => 2, 'air_plane_class_id' => 1, 'price' => 200, 'departs_at' => Carbon::now()->addDays(1), 'lands_at' => Carbon::now()->addDays(1)->addHours(4)],
            ['air_port_from' => 3, 'air_port_to' => 7, 'air_plane_class_id' => 3, 'price' => 274, 'departs_at' => Carbon::now()->addDays(2), 'lands_at' => Carbon::now()->addDays(2)->addHours(6)->addMinutes(32)],
        ];

        Country::insert($countries);
        City::insert($cities);
        AirPort::insert($airPorts);
        AirPlane::insert($airPlanes);
        AirPlaneClass::insert($airPlaneClasses);
        Ticket::insert($tickets);
    }
}
