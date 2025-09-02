<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses()->orderBy('is_default', 'desc')->orderBy('created_at', 'desc')->get();
        
        return response()->json($addresses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'address_line' => 'required|string',
            'postal_code' => 'nullable|string|max:10',
            'type' => 'required|in:billing,shipping,both',
            'is_default' => 'boolean',
        ]);

        $address = Auth::user()->addresses()->create($request->all());

        return response()->json([
            'message' => 'Adres başarıyla eklendi.',
            'address' => $address
        ], 201);
    }

    public function update(Request $request, UserAddress $address)
    {
        if ($address->user_id !== Auth::id()) {
            return response()->json(['message' => 'Yetkisiz işlem.'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'address_line' => 'required|string',
            'postal_code' => 'nullable|string|max:10',
            'type' => 'required|in:billing,shipping,both',
            'is_default' => 'boolean',
        ]);

        $address->update($request->all());

        return response()->json([
            'message' => 'Adres başarıyla güncellendi.',
            'address' => $address
        ]);
    }

    public function destroy(UserAddress $address)
    {
        if ($address->user_id !== Auth::id()) {
            return response()->json(['message' => 'Yetkisiz işlem.'], 403);
        }

        $address->delete();

        return response()->json(['message' => 'Adres başarıyla silindi.']);
    }

    public function setDefault(UserAddress $address)
    {
        if ($address->user_id !== Auth::id()) {
            return response()->json(['message' => 'Yetkisiz işlem.'], 403);
        }

        Auth::user()->addresses()
            ->where('type', $address->type)
            ->update(['is_default' => false]);

        $address->update(['is_default' => true]);

        return response()->json(['message' => 'Varsayılan adres güncellendi.']);
    }
}