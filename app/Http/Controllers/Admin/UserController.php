<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UsersRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = UsersRole::query()
            ->get()
            ->keyBy('id');

        $user = Auth::user();

        $users = User::query()
            ->where('id', '<>', $user->id)
            ->get();

        if ($user->role_id !== 1) {

            return back()->with('error', 'У вас нет прав на доступ к даноому ресурсу!');

        } else {
            return view('admin.users', [
                'roles' => $roles,
                'users' => $users
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = UsersRole::query()
            ->get()
            ->keyBy('id');

        return view('admin.user-create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $request->flash();

        $this->validate($request, $user::createRules($user->id), [], User::attributesForRules());

        $result = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        if ($result) {
            return redirect()
                ->route('user.index')
                ->with('success', 'Пользователь успешно создан!');
        } else {
            return redirect()
                ->route('user.create')
                ->with('error', 'Ошибка создания пользователя!');
        }
    }

    /**
     * Edit password the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function editPassword(User $user)
    {
        if (!$user) {

            return back()->with('error', 'Такого пользователя не найдено!');

        } else {
            return view('admin.password_update', [
                'user' => $user
            ]);
        }
    }

    /**
     * Update password the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */

    public function updatePassword(Request $request, User $user)
    {
        $this->validate($request, $user::passwordRules());

        $result = $user->update([

            'password' => Hash::make($request->password),
        ]);

        if ($result) {
            return redirect()
                ->route('user.edit', $user)
                ->with('success', 'Пароль успешно изменен!');
        } else {
            return redirect()
                ->route('user.edit', $user)
                ->with('error', 'Ошибка изменения пароля!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = UsersRole::query()
            ->get()
            ->keyBy('id');

        return view('admin.user-create', [
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->flash();

        $this->validate($request, $user::insertRules($user->id), [], User::attributesForRules());

        $result = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);

        if ($result) {
            return redirect()
                ->route('user.index')
                ->with('success', 'Пользователь успешно отредактирован!');
        } else {
            return redirect()
                ->route('user.update')
                ->with('error', 'Ошибка сохранения пользователя!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {

            return back()->with('success', 'Пользователь удален!');
        } else {

            return back()->with('error', 'Ошибка удаления пользователя!');
        }
    }
}
