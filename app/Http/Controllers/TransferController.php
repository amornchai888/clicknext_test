<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function transfer(Request $request)
    {

        $request->validate([
            'account_no' => ['required'],
            'amount' =>  ['required'],
        ]);


        $transferAmount =  floatval($request->input('amount'));

        $userId = $request->user()->id;
        try {

            $fromAccount = Account::where('user_id', $userId)->firstOrFail();
            $toAccount = Account::where('user_id', $request->input('account_no'))->first();

            if (!$toAccount) {
                throw new \ErrorException('บัญชีไม่ถูกต้อง');
            }

            if ($fromAccount->balance < $transferAmount) {
                throw new \ErrorException('เงินไม่พอ');
            }

            DB::beginTransaction();

            //Update 
            $formAccBalance = $fromAccount->balance - $transferAmount;
            $toAccBalance = $toAccount->balance + $transferAmount;

            $toAccount->balance = $toAccBalance;
            $toAccount->save();

            $fromAccount->balance = $formAccBalance;
            $toAccount->save();

            DB::commit();

            return response()->json([
                'result' => 1,
                'balance' => $formAccBalance,
                'message' => "โอนเงินสำเร็จ",
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
