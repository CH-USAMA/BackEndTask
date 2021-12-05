<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Bookings;

use Illuminate\Http\Request;

class RoomsController extends Controller
{
    

    /**
     * get Rooms 
     *
     * @return \Illuminate\Http\Response
     */
    public function getRooms()
    {
        $url = urlencode('https://www.airbnb.com/s/Beirut/homes');
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.proxycrawl.com/?token=ESEZiebKqEdTwXuG9frvuA&get_cookies=true&scraper=airbnb-serp&format=json&url='.$url.'&page_wait=5000&ajax_wait=true');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);
        foreach( $data->body->residents as $room)
        {
         
            $rooom = Rooms::create([
                'title' => $room->title,
                'superHost' => $room->superHost,
                'residentType' => $room->residentType,
                'location' => $room->location,
                'samplePhotoUrl' => $room->samplePhotoUrl,
                'guests' => $room->accommodation->guests,
                'bedrooms' => $room->accommodation->bedrooms,
                'beds' => $room->accommodation->beds,
                'baths' => $room->accommodation->baths,
                'rating' => $room->rating,
                'personReviewed' => $room->personReviewed,
                'costs' => $room->costs->priceCurrency.''.$room->costs->pricePerNight,
            ]);


        }

        $response = [
            'ROOMS' => $data,
            'status' => 'Rooms Saved to database'
        ];

        return response($response, 201);
       
    }

    public function top5Rooms() //from api
    {
        $url = urlencode('https://www.airbnb.com/s/Beirut/homes');
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.proxycrawl.com/?token=ESEZiebKqEdTwXuG9frvuA&get_cookies=true&scraper=airbnb-serp&format=json&url='.$url.'&page_wait=5000&ajax_wait=true');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        $data = json_decode($response);
        // return $data;
        for($i = 0 ; $i <= 5 ; $i++ )
        {
            print_r($data->body->residents[$i]);
        } 
        return 0;
     
    }



    public function top5RoomsDB() //from database
    {
        $data = Rooms::orderBy('personReviewed', 'DESC')->limit(5)->get();

        // $data = Rooms::selectRaw("*")
        //       ->orderBy('personReviewed','ASC')
        //       ->limit('5')
        //       ->get();

        $response = [
            'Top 5 Rooms' => $data,
            'status' => 'Top 5 Rooms Based on rating'
        ];

        return response($response, 201);
     
    }


    public function BookRoom(Request $request) //from database
    {
        // $newestCliente = Cliente::orderBy('rating', 'desc')->first();
        $fields = $request->validate([
            'user_email' => 'required|string',
            'rooms_id' => 'required|integer',
            'time' => 'required|string',
            'no_of_days' => 'required|integer',
        ]);

        $Bookings = Bookings::create([
            'email' => $fields['user_email'],
            'rooms_id' => $fields['rooms_id'],
            'time' => $fields['time'],
            'no_of_days' => $fields['no_of_days'],
        ]);


        $response = [
            'Room Booking' => $Bookings,
            'status' => 'Your Room is Booked'
        ];

        return response($response, 201);
     
    }
}
