<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::paginate(10);
        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.positions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_salary' => 'required|numeric|min:0',
        ]);

        Position::create($validated);
        return redirect()->route('admin.positions.index')->with('success', 'Position created successfully.');
    }

    public function edit(Position $position)
    {
        return view('admin.positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:positions,title,' . $position->id,
            'description' => 'nullable|string',
            'base_salary' => 'required|numeric|min:0',
        ]);

        $position->update($validated);
        return redirect()->route('admin.positions.index')->with('success', 'Position updated successfully.');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('admin.positions.index')->with('success', 'Position deleted successfully.');
    }
}
