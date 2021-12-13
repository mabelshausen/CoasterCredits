<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Repositories\CoasterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoasterController extends Controller
{
    private $coastersPerPage = 30;

    protected $coasterRepo;
    protected $currentPage;
    protected $lastPage;

    public function __construct(CoasterRepository $coasterRepo)
    {
        $this->coasterRepo = $coasterRepo;
    }

    public function showCoasters() {
        $this->currentPage = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $this->lastPage = ceil($this->coasterRepo->count() / $this->coastersPerPage);

        $credits = Credit::where('user_id', Auth::user()->id)->get();
        $creditsTransform = [];
        foreach ($credits as $credit) {
            $creditsTransform[$credit->coaster_id] = $credit->first_ride_date;
        }

        return view('dashboard', [
            'coasters' => $this->coasterRepo->all($this->currentPage),
            'currentPage' => $this->currentPage,
            'lastPage' => $this->lastPage,
            'credits' => $creditsTransform
        ]);
    }

    public function showCoasterDetail($id) {
        return view('coaster-detail', [
            'coaster' => $this->coasterRepo->get($id)
        ]);
    }
}
