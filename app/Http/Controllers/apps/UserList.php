<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserList extends Controller
{
  public function index()
  {
    return view('content.apps.app-user-list');
  }
  public function create()
  {
    // $routes = array_merge($regions, $subregions, $zones);
    $regions = Region::all();
    $subregions = Subregion::all();
    $routes = Area::all();
    $roles= Role::all();
    return view('app.users.create', [
      "routes" => $routes,
      "regions" => $regions,
      "subregions" => $subregions,
      "roles"=>$roles

    ]);
  }
  //store
  public function store(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email|unique:users',
      'name' => 'required',
      'phone_number' => 'required|unique:users',
      'account_type' => 'required',
      'region' => 'required',
    ]);
    $user_code = Str::random(20);
    //save user
    $code = rand(100000, 999999);
    $user=User::updateOrCreate(
      [
        "user_code" => $user_code,
      ],
      [
        "email" => $request->email,
        "phone_number" => $request->phone_number,
        "name" => $request->name,
        "account_type" => $request->account_type,
        "email_verified_at" => now(),
        "route_code" => 'route_code',
        "region_id" => $request->region,
        "status" => 'Active',
        "password" => Hash::make($request->phone_number),
        "business_code" => FacadesAuth::user()->business_code,

      ]
    );


    $van_sales = $request->van_sales == null ? "NO" : "YES";
    $new_sales = $request->new_sales == null ? "NO" : "YES";
    $deliveries = $request->deliveries == null ? "NO" : "YES";
    $schedule_visits = $request->schedule_visits == null ? "NO" : "YES";
    $merchanizing = $request->merchanizing == null ? "NO" : "YES";
    AppPermission::updateOrCreate(
      [
        "user_code" => $user_code,

      ],
      [
        "van_sales" => $van_sales,
        "new_sales" => $new_sales,
        "schedule_visits" => $schedule_visits,
        "deliveries" => $deliveries,
        "merchanizing" => $merchanizing,
      ]
    );
    $role = Role::where('name', $request->account_type)->first();
    if ($role){
      $user->roles()->sync([$role->id]); // Assign the role to the user

      // Assign permissions associated with the role to the user
      $permissions = $role->permissions;

      $user->permissions()->sync($permissions->pluck('id'));

    }


    Session()->flash('success', 'User Created Successfully, Default Password is Phone_number');
    $random = Str::random(20);
    $activityLog = new activity_log();
    $activityLog->activity = 'Adding User';
    $activityLog->user_code = auth()->user()->user_code;
    $activityLog->section = 'Creating User';
    $activityLog->action = 'User ' . $request->name . ' Role ' . $request->account_type . ' Created Successfully';
    $activityLog->userID = auth()->user()->id;
    $activityLog->activityID = $random;
    $activityLog->ip_address = "";
    $activityLog->save();
//      return redirect()->back();
    return redirect()->to(url()->previous());
  }

  //edit
  public function edit($user_code)
  {
    //abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $edit = User::where('user_code', $user_code)
//         ->where('business_code', FacadesAuth::user()->business_code)
      ->first();

    $permissions = AppPermission::where('user_code', $user_code)->firstOrFail();

    $regions = Region::all();
    $user_region=Region::where('id', $edit->region_id)->first();
    $roles= Role::all();
    $edit->load('roles');
    return view('app.users.edit', [
      'edit' => $edit,
      'user_code' => $user_code,
      'permissions' => $permissions,
      'regions' => $regions,
      'roles' =>$roles,
      'user_region'=>$user_region
    ]);
  }
  public function show($user_code)
  {
    $edit = User::where('user_code', $user_code)
      ->where('business_code', FacadesAuth::user()->business_code)
      ->first();

    $permissions = AppPermission::where('user_code', $user_code)->firstOrFail();
    $user_role=Role_user::where('user_id', $edit->id)->first();
    $role_detail=[];
    if($user_role){
      $role_detail=Role::where('id', $user_role->role_id)->with('permissions')->get();
    }
    $regions = Region::all();
    $roles= Role::all();
    return view('app.users.view', [
      'user' => $edit,
      'user_code' => $user_code,
      'permissions' => $permissions,
      'regions' => $regions,
      'roles' =>$roles,
      'role_detail'=>$role_detail
    ]);
  }

  //update
  public function update(Request $request, $user_code)
  {
    $this->validate($request, [
      'email' => 'required',
      'name' => 'required',
      'phone_number' => 'required',
      'account_type' => 'required',
    ]);

    $user=User::updateOrCreate(
      [
        "user_code" => $user_code,
        "business_code" => FacadesAuth::user()->business_code,
      ],
      [
        "email" => $request->email,
        "phone_number" => $request->phone_number,
        "name" => $request->name,
        "account_type" => $request->account_type,
        "status" => 'Active',
        "region_id" => $request->region,

      ]
    );
    $van_sales = $request->van_sales == null ? "NO" : "YES";
    $new_sales = $request->new_sales == null ? "NO" : "YES";
    $deliveries = $request->deliveries == null ? "NO" : "YES";
    $schedule_visits = $request->schedule_visits == null ? "NO" : "YES";
    $merchanizing = $request->merchanizing == null ? "NO" : "YES";
    AppPermission::updateOrCreate(
      [
        "user_code" => $user_code,
      ],
      [
        "van_sales" => $van_sales,
        "new_sales" => $new_sales,
        "schedule_visits" => $schedule_visits,
        "deliveries" => $deliveries,
        "merchanizing" => $merchanizing,
      ]
    );
    $role=Role::where('name', $request->account_type)->first();
    if ($role){
      $user->roles()->sync($role->id);
    }
    Session()->flash('success', 'User updated Successfully');

    $random = Str::random(20);
    $activityLog = new activity_log();
    $activityLog->activity = 'User update';
    $activityLog->user_code = auth()->user()->user_code;
    $activityLog->section = 'User update';
    $activityLog->action = 'User ' . $request->name . ' updated';
    $activityLog->activityID = $random;
    $activityLog->ip_address = "";
    $activityLog->save();

//      return redirect()->back();

    $role=$request->initial_role;
    $users = User::where('account_type',$role);
    $description=Role::where('name', $role)->first();
    if (!empty($description)){
      return view('app.users.index', compact('users', 'description', 'role'));
    }
    return redirect()->to(url()->previous());
  }
}
