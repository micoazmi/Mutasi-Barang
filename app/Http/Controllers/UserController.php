<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|min:6'
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));
        return $user;
    }

    public function destroy($id) {
        return User::destroy($id);
    }

 
}
