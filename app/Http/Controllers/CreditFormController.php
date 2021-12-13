<?php


namespace App\Http\Controllers;


use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditFormController extends Controller
{

    public function showForm($id) {
        return view('credit-form', [
            'coaster_id' => $id
        ]);
    }

    public function saveCredit(Request $request, $id) {
        $credit = new Credit();
        $credit->user_id = Auth::user()->id;
        $credit->coaster_id = $id;

        //validate
        $credit->first_ride_date = $request->first_ride_date;
        $credit->rides_count = $request->rides_count;

        $credit->save();
        return redirect()->route('credits');
    }
}
