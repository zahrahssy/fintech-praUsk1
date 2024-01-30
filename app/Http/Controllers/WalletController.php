<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topUp(Request $request)
    {
        $user_id = Auth::user()->id;
        $credit = $request->credit;
        $description = 'Top up saldo';
        $status = 'proses';

        Wallet::create([
            'user_id' => $user_id,
            'credit' => $credit,
            'description' => $description,
            'status' => $status,
        ]);

        return redirect()->back()->with('status', 'Berhail request topUp');
    }

    public function topUp1(Request $request)
    {
        $user_id = $request->id;
        $credit = $request->credit;
        $description = 'Top up saldo';
        $status = 'selesai';

        Wallet::create([
            'user_id' => $user_id,
            'credit' => $credit,
            'description' => $description,
            'status' => $status,
        ]);

        return redirect()->back()->with('status', 'Berhail topUp');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withDrawal(Request $request)
    {
        $user_id = Auth::user()->id;
        $debit = $request->debit;
        $description = 'Withdrawal saldo';
        $status = 'proses';
        $wallet = Wallet::where('user_id', $user_id)->first();

        if ($wallet->credit < $request->debit) {
            return redirect()->back()->with('status', 'Saldo anda kurang');
        }

        Wallet::create([
            'user_id' => $user_id,
            'debit' => $debit,
            'description' => $description,
            'status' => $status,
        ]);

        return redirect()->back()->with('status', 'Berhail request withDrawal');
    }

    public function withDrawal1(Request $request)
    {
        $user_id = $request->id;
        $debit = $request->debit;
        $description = 'Withdrawal saldo';
        $status = 'selesai';
        $wallet = Wallet::where('user_id', $user_id)->first();

        if ($wallet->credit < $request->debit) {
            return redirect()->back()->with('status', 'Saldo anda kurang');
        }
        Wallet::create([
            'user_id' => $user_id,
            'debit' => $debit,
            'description' => $description,
            'status' => $status,
        ]);

        return redirect()->back()->with('status', 'Berhasil withDrawal');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accRequest(Request $request)
    {
        $wallet_id = $request->wallet_id;

        Wallet::find($wallet_id)->update([
            'status' => 'selesai'
        ]);

        return redirect()->back()->with('status', 'Berhail approve request');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
