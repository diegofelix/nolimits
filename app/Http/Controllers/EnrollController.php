<?php
namespace App\Http\Controllers;

use App\Http\Requests\EnrollRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use NoLimits\Enrollment\Repository;

class EnrollController extends Controller
{
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function show(string $enrollId): View
    {
        $enroll = $this->repository->first($enrollId);

        return view('enrolls.show', compact('enroll'));
    }

    public function store(string $championshipSlug, EnrollRequest $request): RedirectResponse
    {
        if ($enroll = $this->repository->newEnroll($championshipSlug, $request)) {
            return redirect()->route('showEnroll', $enroll->getKey());
        }
    }
}
