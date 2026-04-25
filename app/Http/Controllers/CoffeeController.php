<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoffeeController extends Controller
{
    // 1. Show the Admin Dashboard Table
    public function index()
    {
        $coffees = Coffee::latest()->paginate(10);
        return view('admin.dashboard', compact('coffees'));
    }

    // 2. Show the Create Form
    public function create()
    {
        return view('coffees.create');
    }

    // 3. Store a New Coffee
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('coffees', 'public');
        }

        Coffee::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Coffee added to the menu successfully!');
    }

    // 4. Show the Edit Form
    public function edit(Coffee $coffee)
    {
        return view('coffees.edit', compact('coffee'));
    }

    // 5. Update an Existing Coffee
    public function update(Request $request, Coffee $coffee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($coffee->image) {
                Storage::disk('public')->delete($coffee->image);
            }
            $validated['image'] = $request->file('image')->store('coffees', 'public');
        }

        $coffee->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Coffee updated successfully!');
    }

    // 6. Delete a Coffee
    public function destroy(Coffee $coffee)
    {
        if ($coffee->image) {
            Storage::disk('public')->delete($coffee->image);
        }
        
        $coffee->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Coffee removed from the menu.');
    }
}
