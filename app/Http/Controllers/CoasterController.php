<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Repositories\CoasterRepository;
use App\Repositories\ParkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoasterController extends Controller
{
    private $coastersPerPage = 30;

    protected $coasterRepo;
    protected $parkRepo;

    protected $currentPage;
    protected $lastPage;

    public function __construct(CoasterRepository $coasterRepo, ParkRepository $parkRepo)
    {
        $this->coasterRepo = $coasterRepo;
        $this->parkRepo = $parkRepo;
    }

    public function showCoasters() {
        $this->currentPage = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $searchParm = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $this->lastPage = ceil($this->coasterRepo->count() / $this->coastersPerPage);

        if ($searchParm) {
            $coasters = $this->coasterRepo->getByName($searchParm);
        } else {
            $coasters = $this->coasterRepo->all($this->currentPage);
        }

        $credits = Credit::where('user_id', Auth::user()->id)->get();
        $creditsTransform = [];
        foreach ($credits as $credit) {
            $creditsTransform[$credit->coaster_id] = date('d-m-Y', strtotime($credit->first_ride_date));
        }

        return view('dashboard', [
            'coasters' => $coasters,
            'currentPage' => $this->currentPage,
            'lastPage' => $this->lastPage,
            'credits' => $creditsTransform
        ]);
    }

    public function showCoasterDetail($id) {
        $coaster = $this->coasterRepo->get($id);

        return view('coaster-detail', [
            'coaster' => $coaster,
            'park' => $this->parkRepo->get($coaster->park_id)
        ]);
    }
}
