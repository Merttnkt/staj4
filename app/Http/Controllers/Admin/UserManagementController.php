<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        
        $users = User::when($status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $counts = [
            'pending' => User::where('status', 'pending')->count(),
            'approved' => User::where('status', 'approved')->count(),
            'rejected' => User::where('status', 'rejected')->count(),
            'suspended' => User::where('status', 'suspended')->count(),
            'total' => User::count(),
        ];

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'counts' => $counts,
            'currentStatus' => $status,
        ]);
    }

    public function approve(User $user)
    {
        $user->update(['status' => 'approved']);

        return back()->with('success', $user->name . ' kullanıcısı onaylandı.');
    }

    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);

        return back()->with('success', $user->name . ' kullanıcısı reddedildi.');
    }

    public function suspend(User $user)
    {
        $user->update(['status' => 'suspended']);

        return back()->with('success', $user->name . ' kullanıcısı askıya alındı.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Kullanıcı silindi.');
    }
}
