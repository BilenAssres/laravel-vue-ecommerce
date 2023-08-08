<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\returnSelf;

class AdminController extends Controller
{
    private $auth;
    public function __construct()
    {
        $this->auth = new AuthenticatedSessionController;
        return $this->middleware('auth');
    }


    public function dashboard(Request $request)
    {
        $products = Product::with('images')->simplePaginate(50);
        $users = User::where('id', '!=', Auth::id())->simplePaginate(10);
        return view('admin.dashboard', compact('products', 'users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('admin.register');
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([

            'name' => 'required|string|min:4|max:36',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $data = $request->only([
            'name',
            'email'
        ]);
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('admin.dashboard')->with('alert', 'User Successfully Created');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $request->validate([
            'name' => 'required|string|min:4|max:36',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.dashboard')->with('alert', 'Account Successfully updated');
    }
    
    public function destroy(User $user){
        $this->authorize('delete', User::class);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('alert', 'Account Successfully Deleted');
    }
}
