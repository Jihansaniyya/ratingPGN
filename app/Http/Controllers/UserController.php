<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of petugas.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'petugas');
        
        // Search by name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new petugas.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created petugas in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()   // minimal satu huruf kapital dan satu huruf kecil
                    ->symbols(),    // minimal satu simbol
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid. Contoh: nama@email.com',
            'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
            'password.Illuminate\Validation\Rules\Password' => 'Password minimal 8 karakter, harus ada huruf kapital, huruf kecil, dan simbol (!@#$%^&* dll).',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'petugas',
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Akun Petugas berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified petugas.
     */
    public function edit(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat mengedit akun Admin.');
        }
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat mengedit akun Admin.');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ];

        // Only validate password if provided
        if ($request->filled('password')) {
            $rules['password'] = [
                'confirmed',
                Password::min(8)
                    ->mixedCase()   // minimal satu huruf kapital dan satu huruf kecil
                    ->symbols(),    // minimal satu simbol
            ];
        }

        $validated = $request->validate($rules, [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid. Contoh: nama@email.com',
            'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
            'password.Illuminate\Validation\Rules\Password' => 'Password minimal 8 karakter, harus ada huruf kapital, huruf kecil, dan simbol (!@#$%^&* dll).',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Data Petugas berhasil diperbarui!');
    }

    /**
     * Remove the specified petugas from storage.
     */
    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus akun Admin.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Akun Petugas berhasil dihapus!');
    }
}
