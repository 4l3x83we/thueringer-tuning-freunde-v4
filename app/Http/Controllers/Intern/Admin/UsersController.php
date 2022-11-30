<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: UsersController.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 13:47
 */

namespace App\Http\Controllers\Intern\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Intern\Admin\Users;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('intern.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('intern.admin.users.create');
    }

    public function store(User $user, StoreUserRequest $request)
    {
        $user->create(array_merge($request->validated(), [
            'password' => 'test'
        ]));

        return redirect()->route('intern.admin.users.index')
            ->withSuccess(__('User created successfully.'));
    }

    public function show(Users $user)
    {
        return view('intern.admin.users.show', [
            'user' => $user
        ]);
    }

    public function edit(Users $user)
    {
        return view('intern.admin.users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    public function update(Request $request, Users $user)
    {
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect()->route('intern.admin.users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    public function destroy(Users $user)
    {
        $user->delete();

        return redirect()->route('intern.admin.users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}
