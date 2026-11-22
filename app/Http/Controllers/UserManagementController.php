<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('role', 'like', "%{$search}%")
                      ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalUsers = User::count();

        $activeUsers = User::where('status', 'Active')->count();

        $inactiveUsers = User::where('status', 'Inactive')->count();

        return view('user-management', compact(
            'users',
            'search',
            'totalUsers',
            'activeUsers',
            'inactiveUsers'
        ));
    }

    public function edit(User $user)
    {
        $roles = [
            'Administrator',
            'Registrar',
            'Faculty',
            'Staff',
        ];

        return view('user-edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
            'role' => [
                'required',
                'in:Administrator,Registrar,Faculty,Staff',
            ],
        ]);

        $user->update($validated);

        return redirect()
            ->route('user-management.index')
            ->with('success', 'User account successfully updated!');
    }

    public function toggleStatus(User $user)
    {
        $newStatus = $user->status === 'Active'
            ? 'Inactive'
            : 'Active';

        $user->update([
            'status' => $newStatus,
        ]);

        $message = $newStatus === 'Active'
            ? 'User account has been activated successfully.'
            : 'User account has been deactivated successfully.';

        return redirect()
            ->route('user-management.index')
            ->with('success', $message);
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'Staff',
        'status' => 'Active',
    ]);

    return redirect()
        ->route('user-management.index')
        ->with('success', 'User successfully registered!');
}

}


