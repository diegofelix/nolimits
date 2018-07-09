<?php
namespace NoLimits\Enrollment;

use App\Http\Requests\EnrollRequest;
use NoLimits\Championship\Championship;
use NoLimits\Championship\Competition;

class MakeNewEnroll
{
    /**
     * @var Championship
     */
    private $championship;

    /**
     * @var EnrollRequest
     */
    private $request;

    public function makeWith(Championship $championship, EnrollRequest $request): Enroll
    {
        $this->request = $request;
        $this->championship = $championship;

        $user = $request->user();

        $enroll = app(Enroll::class);
        $enroll->competitions = $this->getUserSelectedCompetitions();
        $enroll->attach('user', $user);
        $enroll->attach('championship', $championship);

        return $enroll;
    }

    private function getUserSelectedCompetitions(): array
    {
        $requestCompetitions = array_keys($this->request->get('competitions'));

        return $this->filterChampionshipCompetitions($requestCompetitions);
    }

    private function filterChampionshipCompetitions(array $requestCompetitions): array
    {
        foreach ($this->championship->competitions() as $competition) {
            if ($this->userChoseCompetition($requestCompetitions, $competition)) {
                $userCompetitions[] = $competition->toArray();
            }
        }

        return $userCompetitions ?? [];
    }

    private function userChoseCompetition(array $requestCompetitions, Competition $competition): bool
    {
        return in_array($competition->getKey(), $requestCompetitions);
    }
}
