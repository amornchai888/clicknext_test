<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getAccountData(Request $request)
    {
        $userId = $request->user()->id;

        $account = Account::where('user_id', $userId)->firstOrFail();
        $data = [
            'account_no' => $account->account_no,
            'balance' => number_format($account->balance),
            'history' => []
        ];

        return response()->json($data, 200);
    }
}
