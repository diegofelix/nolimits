<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use NoLimits\Championship\Championship;

class ChampionshipsController extends Controller
{
    public function show(string $championshipSlug): View
    {
        $championship = Championship::firstOrFail(['slug' => $championshipSlug]);

        return view('championships.show', compact('championship'));
    }
}
