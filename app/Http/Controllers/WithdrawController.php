<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function withdraw(Request $request)
    {

        $request->validate([
            'amount' => ['required']
        ]);


        $userId = $request->user()->id;
        $withDrawAmount =  floatval($request->input('amount'));

        try {

            $account = Account::where('user_id', $userId)->firstOrFail();
            $acc_balance = $account->balance;

            if ($account->balance < $withDrawAmount) {
                throw new \ErrorException('เงินไม่พอ');
            }

            DB::beginTransaction();

            $new_balance = $acc_balance - $withDrawAmount;

            $account->balance = $new_balance;
            $account->save();

            DB::commit();

            return response()->json([
                'result' => true,
                'balance' => $new_balance,
                'message' => "ถอนเงินสำเร็จ",
            ], 200);


        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
