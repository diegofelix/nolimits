<?php
namespace App\Http\Controllers;

use App\Http\Requests\EnrollRequest;
use Illuminate\Contracts\View\View;
use NoLimits\Championship\Championship;
use NoLimits\Championship\Enroll;

class ChampionshipsController extends Controller
{
    public function show(string $championshipSlug): View
    {
        $championship = Championship::firstOrFail(['slug' => $championshipSlug]);

        return view('championships.show', compact('championship'));
    }

    public function enroll(string $championshipSlug, EnrollRequest $request): View
    {
        $championship = Championship::firstOrFail(['slug' => $championshipSlug]);
        $requestCompetitions = array_keys($request->competitions);
        foreach ($championship->competitions as $competition) {
            if (in_array($competition['_id'], $requestCompetitions)) {
                $selectedCompetitions[] = $competition;
            }
        }

        dd($selectedCompetitions);

        $enroll = new Enroll();

        return view('championships.enroll', compact('championship'));
    }
}
