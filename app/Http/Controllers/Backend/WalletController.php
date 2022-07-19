<?php

namespace App\Http\Controllers\Backend;

use App\Models\Wallet;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Yajra\Datatables\Datatables;





class WalletController extends Controller
{
    public function index(){
        return view('backend.wallet.index');
    }

    public function ssd(){
       // $wallets = Wallet::query();
       // Using eager loading
        $wallets = Wallet::with('user');

        return Datatables::of($wallets)
            ->addColumn('account_person', function($each){
                $user =  $each->user;
                if($user){
                    return '<p>Name : '.$user->name.' </p><p>Email : '.$user->email.'</p><p>Phone : '.$user->phone.'</p>';
                }
                return '-';
            })
            ->editColumn('amount', function($each){
                return number_format($each->amount, 2);
            })
            ->editColumn('created_at', function($each){
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function($each){
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns(['account_person'])
            ->make(true);
    }

    public function addAmount(){
        $users = User::orderBy("name")->get();
        return view('backend.wallet.add_amount', compact('users'));
    }

    public function addAmountStore(Request $request){
       $request->validate(
           [
            'user_id' => 'required',
            'amount' => 'required|integer',
           ],
           [
                'user_id.required' => 'The user field is required.',
           ]
           );
           if($request->amount < 1000) {
               return back()->withErrors(['amount' => 'The amount must be at least 1000 MMK.'])->withInput();
           }

           $to_account = User::with('wallet')->where('id', $request->user_id)->firstOrFail();
           $to_account_wallet->increment('amount', $amount);
           $to_account_wallet->update();
    }

}
