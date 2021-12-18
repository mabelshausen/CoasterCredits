<?php


namespace App\Http\Controllers;


use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditFormController extends Controller
{

    public function showForm($id) {
        $credit = Credit::where(['coaster_id' => $id, 'user_id' => Auth::user()->id])->firstOrNew();
        return view('credit-form', [
            'coaster_id' => $id,
            'first_ride_date' => date('Y-m-d', strtotime($credit->first_ride_date)),
            'rides_count' => $credit->rides_count
        ]);
    }

    public function saveCredit(Request $request, $id) {
        $credit = Credit::where(['coaster_id' => $id, 'user_id' => Auth::user()->id])->firstOrNew();
        $credit->user_id = Auth::user()->id;
        $credit->coaster_id = $id;

        //validate
        $credit->first_ride_date = $request->first_ride_date;
        $credit->rides_count = $request->rides_count;

        $credit->save();
        return redirect()->route('credits');
    }
}
