<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page'] = 'Daftar';
        return view('pages.family.index', $data);
    }

    public function dataTable(){
        $data = Family::paginate(10);
        
        $formattedData = [
            'page' => $data->currentPage(),
            'pageCount' => $data->lastPage(),
            'sortField' => null, // Optional sorting field
            // 'sortField' => $request->get('sortField', null), // Optional sorting field
            'sortOrder' => null, // Optional sorting order
            // 'sortOrder' => $request->get('sortOrder', null), // Optional sorting order
            'totalCount' => $data->total(),
            'data' => $data->map(function ($item, $index) use ($data) {
                return [
                'no' => ($data->firstItem() + $index),
                'id' => $item->id,
                'image' => $item->image,
                'zone' => $item->zone,
                'name' => $item->name,
                'members_amount' => $item->members_amount,
                'address' => $item->address,
                'joinDate' => $item->joinDate,
                ];
            })->toArray(),
        ];

        return response()->json($formattedData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page'] = 'Tambah';
        return view('pages.family.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'zone'     => 'required|integer',
            'column'     => 'required|integer',
            'name'     => 'required|string',
            'members_amount'   => 'required|integer',
            'address'  => 'nullable|string',
            'joinDate' => 'required|date',
            'image'    => 'nullable|image|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('family', 'public');
        }
    
        $family = Family::create($validated);

        if(!$family){
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Gagal menambahkan data keluarga!',
            ]);
        }

        return redirect()->route('family')->with([
            'status' => 'success',
            'message' => 'Berhasil menambahkan data keluarga!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['page'] = 'Ubah';
        $data['data'] = Family::find($id);
        return view('pages.family.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $family = Family::findOrFail($id);

        $validated = $request->validate([
            'zone'     => 'required|integer',
            'column'   => 'required|integer',
            'name'     => 'required|string',
            'members_amount'   => 'required|numeric',
            'address'  => 'nullable|string',
            'joinDate' => 'required|date',
            'image'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($family->image) {
                Storage::disk('public')->delete($family->image);
            }

            $validated['image'] = $request->file('image')->store('family', 'public');
        }

        $updated = $family->update($validated);

        if(!$updated){
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Gagal mengubah data keluarga!',
            ]);
        }

        return redirect()->route('family')->with([
            'status' => 'success',
            'message' => 'Berhasil megubah data keluarga!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $family = Family::findOrFail($id);

        if ($family->image) {
            Storage::disk('public')->delete($family->image);
        }

        $deleted = $family->delete();

        if(!$deleted){
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal meghapus data keluarga!'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil meghapus data keluarga!'
        ], 200);
    }
}
