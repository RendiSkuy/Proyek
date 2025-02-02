<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminRewardsController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('admin.rewards.index', compact('rewards'));
    }

    public function create()
    {
        return view('admin.rewards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:3072', // 3MB limit
        ]);

        $imagePath = $request->file('image')->store('rewards', 'public');

        Reward::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.rewards.index')->with('success', 'Reward berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $reward = Reward::findOrFail($id);
        return view('admin.rewards.edit', compact('reward'));
    }

    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:3072', // Optional image update
        ]);

        if ($request->hasFile('image')) {
            if ($reward->image) {
                Storage::disk('public')->delete($reward->image);
            }
            $imagePath = $request->file('image')->store('rewards', 'public');
            $reward->image = $imagePath;
        }

        $reward->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.rewards.index')->with('success', 'Reward berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        
        if ($reward->image) {
            Storage::disk('public')->delete($reward->image);
        }

        $reward->delete();
        return redirect()->route('admin.rewards.index')->with('success', 'Reward berhasil dihapus.');
    }
}
