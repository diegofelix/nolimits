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

    public function __construct(Championship $championship, EnrollRequest $request)
    {
        $this->championship = $championship;
        $this->request = $request;
    }

    public function make(): Enroll
    {
        $enroll = new Enroll();
        $enroll->competitions = $this->getUserSelectedCompetitions();
        $enroll->attach('user', $this->request->user());
        $enroll->attach('championship', $this->championship);

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
