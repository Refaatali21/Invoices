<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('users'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
        }


        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function create()
        {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));

        }
        /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
        public function store()
        {

    $data =  $this->validate(request(), [

        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|same:confirm-password',
        'Status'=>'required|in:مفعل,غير مفعل',
        'roles_name' => 'required'
        ],[],[
            'name'=>'اسم المستخدم',
            'email'=>'البريد الالكتروني',
            'password'=>'كلمة المرور',
            'roles_name'=>'الصلاحية'
        ]);





        $user = User::create($data);
        $user->assignRole(request('roles_name'));
        return redirect()->route('users.index')
        ->with('success','تم اضافة المستخدم بنجاح');
        }

        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function show($id)
        {
        $user = User::find($id);
        return view('users.show',compact('user'));
        }
        /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function edit($id)
        {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
        }
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm-password',
        'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
        $input['password'] = Hash::make($input['password']);
        }else{
        $input = array_except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
        ->with('success','تم تحديث معلومات المستخدم بنجاح');
        }
        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function destroy(Request $request)
        {
        User::find($request->user_id)->delete();
        return redirect()->route('users.index')->with('success','تم حذف المستخدم بنجاح');
        }
}
