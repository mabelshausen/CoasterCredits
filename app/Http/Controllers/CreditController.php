<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Repositories\CoasterRepository;
use App\Repositories\ParkRepository;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{

    protected $coasterRepo;
    protected $parkRepo;

    public function __construct(CoasterRepository $coasterRepo, ParkRepository  $parkRepo)
    {
        $this->coasterRepo = $coasterRepo;
        $this->parkRepo = $parkRepo;
    }

    public function showCredits() {
        $credits = Credit::where('user_id', Auth::user()->id)->get();
        $coasters = [];
        $parks = [];

        foreach ($credits as $credit) {
            $coasters[$credit->id] = $this->coasterRepo->get($credit->coaster_id);
            $park = $this->parkRepo->get($coasters[$credit->id]->park_id);

            if (!in_array($park, $parks)) {
                array_push($parks, $park);
            }
        }

        return view('credits', [
            'credits' => $credits,
            'coasters' => $coasters,
            'parks' => $parks
        ]);
    }
}
