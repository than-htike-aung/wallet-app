<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UUIDGenerate;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AdminUser;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Models\Wallet;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index(){
       // $users = AdminUser::all();
        return view('backend.user.index');
    }

    public function ssd(){
        $data = User::query();
        return Datatables::of($data)
            ->editColumn('user_agent', function($each){
               
               if($each->user_agent){
                $agent = new Agent();
                $agent->setUserAgent($each->user_agent);
                $device = $agent->device();
                $platform = $agent->platform();
                $browser = $agent->browser();
                
                return ' <table class="table table-bordered">
                <tbody>
                    <tr><td>Device</td><td>'.$device.'</td></tr>
                    <tr><td>Platform</td><td>'.$platform.'</td></tr>
                    <tr><td>Browser</td><td>'.$browser.'</td></tr>
                </tbody>
            </table>';
               } else {
                   return "-";
               }    
            })
            ->editColumn('created_at', function($each){
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function($each){
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function($each){
                $edit_icon = '<a href="'.route('admin.user.edit', $each->id).'" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<a href="#" class="text-danger delete" data-id="'.$each->id.'"><i class="fas fa-trash-alt"></i></a>';
                return '<div class="action-icon">'. $edit_icon . $delete_icon .'</div>';
            })
            ->rawColumns(['user_agent', 'action'])
            ->make(true);
    }

    public function create() {
        return view('backend.user.create');
    }

    public function store(StoreUserRequest $request){
      //  return $request->all();
      DB::beginTransaction();
      try{
       
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
  
        $user->save();
  
        Wallet::firstOrCreate(
            ['user_id' => $user->id],
            [
                'account_number' => UUIDGenerate::accountNumber(),
                'amount' => 0,
            ]
            );
        DB::commit();
      return redirect()->route('admin.user.index')->with('create', 'Successfully created');

      }catch(\Exception $e){
        DB::rollBack();
          return back()->withErrors(['fail' => 'Something wrong ' , $e->getMessage()])->withInput();
      }
    
    }


    public function edit($id){
        $user = User::findOrFail($id);
        return view('backend.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id){
        //return $request->all();
        DB::beginTransaction();
        try{
         
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->update();

        Wallet::firstOrCreate(
            ['user_id' => $user->id],
            [
                'account_number' => UUIDGenerate::accountNumber(),
                'amount' => 0,
            ]
            );
            DB::commit();
            return redirect()->route('admin.user.index')->with('update', 'Successfully updated');
        
        }catch(\Exception $e){
            DB::rollBack();
              return back()->withErrors(['fail' => 'Something wrong ' , $e->getMessage()])->withInput();
          }
        
       

    }

    public function destroy ($id){
        $user = User::findOrFail($id);
        $user->delete();
        return 'success';
    }
    

}
