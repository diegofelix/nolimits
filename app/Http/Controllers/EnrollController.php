<?php
namespace App\Http\Controllers;

use App\Http\Requests\EnrollRequest;
use Illuminate\Contracts\View\View;
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

    public function index(string $championshipSlug, Request $request)
    {
        $this->repository->findEnrollBy($championshipSlug, $request->user());
    }

    public function store(string $championshipSlug, EnrollRequest $request): View
    {
        if ($enroll = $this->repository->newEnroll($championshipSlug, $request)) {
            return redirect()->route('index', $enroll);
        }
    }
}
