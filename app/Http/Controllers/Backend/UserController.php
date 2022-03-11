<?php

namespace App\Http\Controllers\Backend;

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
use App\Http\Requests\StoreAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;

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
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->phone = $request->phone;

      $user->save();

   
    
    return redirect()->route('admin.user.index')->with('create', 'Successfully created');
    }


    public function edit($id){
        $user = User::findOrFail($id);
        return view('backend.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id){
        //return $request->all();
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->update();

        return redirect()->route('admin.user.index')->with('update', 'Successfully updated');

    }

    public function destroy ($id){
        $user = User::findOrFail($id);
        $user->delete();
        return 'success';
    }
    

}
