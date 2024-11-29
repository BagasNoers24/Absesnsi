<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validation;

class ValidationController extends Controller
{
    // Menampilkan data
    public function index()
    {
        $data = Validation::all();
        //$data['post'] = $this->db->get('posts');
        return view('admin.dashboard', compact('data'));
        
    }

    // Menyimpan data baru
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'jobdesk' => 'required',
    //         'nama' => 'required',
    //         'se' => 'nullable|numeric',
    //         's' => 'nullable|numeric',
    //         'r' => 'nullable|numeric',
    //         'k' => 'nullable|numeric',
    //         'j' => 'nullable|numeric',
    //         'target' => 'required|numeric',
    //         'Avg' => 'required|numeric',
    //         // 'Keterangan' => 'nullable',
    //     ]);

    //     // Validation::create($request->all());
    //     Validation::create($validated);
    //     return redirect()->route('validation.index')->with('success', 'Data berhasil ditambahkan');
    // }
    public function store(Request $request)
{
    $validated = $request->validate([
        'jobdesk' => 'required',
        'nama' => 'required',
        'hari' => 'required',
        'se' => 'nullable|numeric',
        's' => 'nullable|numeric',
        'r' => 'nullable|numeric',
        'k' => 'nullable|numeric',
        'j' => 'nullable|numeric',
        'target' => 'required|numeric',
        'Avg' => 'required|numeric',
        'Keterangan' => 'nullable',
    ]);

    Validation::create($validated);
    return redirect()->route('validation.index')->with('success', 'Data berhasil ditambahkan');
}


    // Menampilkan form edit
    public function edit($id)
    {
        $validation = Validation::findOrFail($id);
        return view('validation.edit', compact('validation'));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        $request->validate([
            'jobdesk' => 'required',
            'nama' => 'required',
            'se' => 'nullable|numeric',
            's' => 'nullable|numeric',
            'r' => 'nullable|numeric',
            'k' => 'nullable|numeric',
            'j' => 'nullable|numeric',
            'target' => 'required|numeric',
            'Avg' => 'required|numeric',
            'Keterangan' => 'nullable',
        ]);

        $validation = Validation::findOrFail($id);
        $validation->update($request->all());
        return redirect()->route('validation.index')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data
    public function destroy($id)
    {
        $validation = Validation::findOrFail($id);
        $validation->delete();
        return redirect()->route('validation.index')->with('success', 'Data berhasil dihapus');
    }
}
