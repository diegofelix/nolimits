<?php
namespace NoLimits\Enrollment;

use App\Http\Requests\EnrollRequest;
use NoLimits\Championship\Championship;

class Repository
{
    /**
     * @var MakeNewEnroll
     */
    private $enrollMaker;

    /**
     * @var PagSeguro
     */
    private $pagSeguro;

    public function __construct(MakeNewEnroll $enrollMaker, PagSeguro $pagSeguro)
    {
        $this->enrollMaker = $enrollMaker;
        $this->pagSeguro = $pagSeguro;
    }

    public function newEnroll(string $championshipSlug, EnrollRequest $request)
    {
        $championship = $this->getChampionship($championshipSlug);
        $enroll = $this->enrollMaker->makeWith($championship, $request);
        $enroll->paymentUrl = $this->pagSeguro->getRedirectUrlForPayment($enroll);
        $enroll->save();

        return $enroll;
    }

    public function first($enrollId)
    {
        return Enroll::firstOrFail($enrollId);
    }

    private function getChampionship(string $championshipSlug): Championship
    {
        return Championship::firstOrFail(['slug' => $championshipSlug]);
    }
}
