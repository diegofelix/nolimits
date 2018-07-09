<?php
namespace NoLimits\Enrollment;

use App\Http\Requests\EnrollRequest;
use Mockery as m;
use NoLimits\Championship\Championship;
use NoLimits\User\User;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    public function testShouldCreateNewEnroll()
    {
        // Set
        $championshipSlug = 'championship-slug';
        $championship = m::mock(Championship::class);
        $request = m::mock(EnrollRequest::class);
        $makeNewEnroll = $this->instance(
            MakeNewEnroll::class,
            m::mock(MakeNewEnroll::class)
        );
        $enroll = m::mock(Enroll::class);
        $pagSeguro = $this->instance(PagSeguro::class, m::mock(PagSeguro::class));
        $paymentUrl = 'http://payment-url.com';

        $repository = new Repository($makeNewEnroll, $pagSeguro);

        // Expectations
        Championship::shouldReceive('firstOrFail')
            ->with(['slug' => $championshipSlug])
            ->andReturn($championship);

        $makeNewEnroll->expects()
            ->makeWith($championship, $request)
            ->andReturn($enroll);

        $pagSeguro->expects()
            ->getRedirectUrlForPayment($enroll)
            ->andReturn($paymentUrl);

        $enroll->expects()
            ->setAttribute('paymentUrl', $paymentUrl);

        $enroll->expects()
            ->save();

        // Actions
        $result = $repository->newEnroll($championshipSlug, $request);

        // Assertions
        $this->assertSame($enroll, $result);
    }
}
