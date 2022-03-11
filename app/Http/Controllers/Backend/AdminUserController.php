<?php

namespace App\Http\Controllers\Backend;

use App\Models\AdminUser;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;
use Carbon\Carbon;

class AdminUserController extends Controller
{
    public function index(){
       // $users = AdminUser::all();
        return view('backend.admin_user.index');
    }

    public function ssd(){
        $data = AdminUser::query();
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
                $edit_icon = '<a href="'.route('admin.admin-user.edit', $each->id).'" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<a href="#" class="text-danger delete" data-id="'.$each->id.'"><i class="fas fa-trash-alt"></i></a>';
                return '<div class="action-icon">'. $edit_icon . $delete_icon .'</div>';
            })
            ->rawColumns(['user_agent', 'action'])
            ->make(true);
    }

    public function create() {
        return view('backend.admin_user.create');
    }

    public function store(StoreAdminUserRequest $request){
      //  return $request->all();
      $admin_user = new AdminUser();
      $admin_user->name = $request->name;
      $admin_user->email = $request->email;
      $admin_user->password = Hash::make($request->password);
      $admin_user->phone = $request->phone;

      $admin_user->save();

   
    
    return redirect()->route('admin.admin-user.index')->with('create', 'Successfully created');
    }


    public function edit($id){
        $admin_user = AdminUser::findOrFail($id);
        return view('backend.admin_user.edit', compact('admin_user'));
    }

    public function update(UpdateAdminUserRequest $request, $id){
        //return $request->all();
        $admin_user = AdminUser::findOrFail($id);
        $admin_user->name = $request->name;
        $admin_user->email = $request->email;
        $admin_user->phone = $request->phone;

        $admin_user->password = $request->password ? Hash::make($request->password) : $admin_user->password;
        $admin_user->update();

        return redirect()->route('admin.admin-user.index')->with('update', 'Successfully updated');

    }

    public function destroy ($id){
        $admin_user = AdminUser::findOrFail($id);
        $admin_user->delete();
        return 'success';
    }

}
