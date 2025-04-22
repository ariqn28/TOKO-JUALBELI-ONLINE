<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NameModel; // Pastikan model yang benar

class NameController extends Controller
{
    public function index()
    {
        $names = NameModel::all();
        return view('names.index', compact('names'));
    }

    public function create()
    {
        return view('names.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        NameModel::create([
            'name' => $request->name,
        ]);

        return redirect()->route('names.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $name = NameModel::findOrFail($id);
        return view('names.show', compact('name'));
    }

    public function edit($id)
    {
        $name = NameModel::findOrFail($id);
        return view('names.edit', compact('name'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name = NameModel::findOrFail($id);
        $name->update([
            'name' => $request->name,
        ]);

        return redirect()->route('names.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $name = NameModel::findOrFail($id);
        $name->delete();

        return redirect()->route('names.index')->with('success', 'Data berhasil dihapus');
    }
}
