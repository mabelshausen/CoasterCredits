<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Repositories\CoasterRepository;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{

    protected $coasterRepo;

    public function __construct(CoasterRepository $coasterRepo)
    {
        $this->coasterRepo = $coasterRepo;
    }

    public function showCredits() {
        $credits = Credit::where('user_id', Auth::user()->id)->get();
        $coasters = [];

        foreach ($credits as $credit) {
            $coasters[$credit->id] = $this->coasterRepo->get($credit->coaster_id);
        }

        return view('credits', [
            'credits' => $credits,
            'coasters' => $coasters
        ]);
    }
}
