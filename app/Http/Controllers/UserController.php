<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\UserSubmitRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{    
    public function index(): View
    {
        return view('auth.user', [
            'users' => User::query()->exceptAdmin()->get()
        ]);
    }
    public function store(UserSubmitRequest $request): RedirectResponse
    {
        user::create($request->validated());
        toast('User added sucessfully', 'success');
        return redirect()->back();
    }

    public function update(Request $request, user $user): RedirectResponse
    {
        $request->validate(['password' => ['required', 'string', 'min:8', 'confirmed']]);
        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->password)
        ]);
        toast('User password changed sucessfully', 'success');
        return redirect()->route('user.index');
    }
}
