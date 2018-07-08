<?php
namespace NoLimits\Enrollment;

use App\Http\Requests\EnrollRequest;
use NoLimits\Championship\Championship;

class Repository
{
    public function newEnroll(string $championshipSlug, EnrollRequest $request)
    {
        $championship = $this->getChampionship($championshipSlug);
        $enroll = $this->makeNewEnroll($request, $championship);
        $enroll->paymentUrl = $this->getPaymentUrl($enroll);
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

    private function getPaymentUrl($enroll): string
    {
        return app(PagSeguro::class, compact('enroll'))->getRedirectUrlForPayment();
    }

    private function makeNewEnroll(EnrollRequest $request, Championship $championship): Enroll
    {
        return app(MakeNewEnroll::class, compact('championship', 'request'))->make();
    }
}
