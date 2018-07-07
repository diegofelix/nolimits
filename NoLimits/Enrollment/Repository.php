<?php
namespace NoLimits\Enrollment;

use App\Http\Requests\EnrollRequest;
use NoLimits\Championship\Championship;
use NoLimits\Championship\Enroll;

class Repository
{
    public function newEnroll(string $championshipSlug, EnrollRequest $request)
    {
        $championship = Championship::firstOrFail(['slug' => $championshipSlug]);
        $requestCompetitions = array_keys($request->get('competitions'));
        $userCompetitions = $this->getCompetitionsFrom($championship, $requestCompetitions);

        $user = $request->user();
        $enroll = new Enroll();
        $enroll->competitions = $userCompetitions;
        $enroll->attach('user', $user);
        $enroll->attach('championship', $championship);
        $enroll->save();

        return $enroll;
    }

    public function findEnrollBy($championshipSlug, $user)
    {
    }

    private function getCompetitionsFrom(Championship $championship, array $requestCompetitions): array
    {
        foreach ($championship->competitions as $competition) {
            if (in_array($competition['_id'], $requestCompetitions)) {
                $userCompetitions[] = $competition;
            }
        }

        return $userCompetitions ?? [];
    }
}
