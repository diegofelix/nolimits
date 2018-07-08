<?php
namespace NoLimits\Enrollment;

use App\Http\Requests\EnrollRequest;
use Mockery as m;
use Mongolid\Model\DocumentEmbedder;
use NoLimits\Championship\Championship;
use NoLimits\Championship\Competition;
use NoLimits\User\User;
use Tests\TestCase;

class MakeNewEnrollTest extends TestCase
{
    public function testShouldGenerateANewEnroll()
    {
        // Set
        $championship = m::mock(Championship::class);
        $request = m::mock(EnrollRequest::class);
        $competition = m::mock(Competition::class);
        $user = m::mock(User::class);
        $enroll = $this->instance(Enroll::class, m::mock(Enroll::class));
        $enrollMaker = new MakeNewEnroll($championship, $request);

        // Expectations
        $request->expects()
            ->get('competitions')
            ->andReturn(['competitionId123' => 'on']);

        $championship->expects()
            ->competitions()
            ->andReturn([$competition]);

        $competition->expects()
            ->getKey()
            ->andReturn('competitionId123');

        $competition->expects()
            ->toArray()
            ->andReturn(['price' => 123]);

        $request->expects()
            ->user()
            ->andReturn($user);

        $enroll->expects()
            ->setAttribute('competitions', [['price' => 123]])
            ->andReturn(null);

        $enroll->expects()
            ->attach('user', $user);

        $enroll->expects()
            ->attach('championship', $championship);

        // Actions
        $result = $enrollMaker->make();

        // Assertions
        $this->assertEquals($enroll, $result);
    }
}
