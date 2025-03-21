<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Requests\UpdateUserBalanceRequest;
use App\Services\BalanceService;

class BalanceController extends Controller
{
    public function __construct(
        protected BalanceService $balanceService
    ) {}


    public function updateBalance( UpdateUserBalanceRequest $balanceRequest) {
        $user = User::findOrFail($balanceRequest->user_id);

        $this->balanceService->queueBalanceUpdate($user, $balanceRequest->validate('amount'));

        return response()->json([
            'msg' => '余额更新成功!',
            'new_balance' => $user->balance
        ]);
    }

}
