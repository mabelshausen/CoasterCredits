<?php

namespace App\Http\Controllers;

use App\Repositories\CoasterRepository;
use Illuminate\Http\Request;

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

        return view('dashboard', [
            'coasters' => $this->coasterRepo->all($this->currentPage),
            'currentPage' => $this->currentPage,
            'lastPage' => $this->lastPage
        ]);
    }

    public function showCoasterDetail($id) {
        return view('coaster-detail', [
            'coaster' => $this->coasterRepo->get($id)
        ]);
    }
}