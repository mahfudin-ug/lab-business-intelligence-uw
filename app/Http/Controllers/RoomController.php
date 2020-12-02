<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Find top course based on GPA
        $rooms = DB::table('room_durations_sem')->where('term_code', '1182')->orderByDesc('duration')->get();

        $avgDuration = number_format($rooms->avg('duration'), 2);
        
        $mostCrowded = $rooms->sortByDesc('duration')->take(10);
        $mostUncrowded = $rooms->sortBy('duration')->take(10);

        $mostCrowded = [
            'label' => $mostCrowded->pluck('name'),
            'value' => $mostCrowded->pluck('duration')
        ];
        $mostUncrowded = [
            'label' => $mostUncrowded->pluck('name'),
            'value' => $mostUncrowded->pluck('duration')
        ];
        
        $roomsDataset = $rooms->map( function($item) {
            return [
                'label' => $item->name,
                'y' => $item->duration
            ];
        });

        return view('room', compact('roomsDataset', 'mostCrowded', 'mostUncrowded', 'avgDuration'));
    }
}
