<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page'] = 'Daftar';
        return view('pages.faq.index', $data);
    }

    public function dataTable(){
        $data = Faq::paginate(10);
        
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
                'question' => $item->question,
                'answer' => $item->answer,
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
        return view('pages.faq.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question'     => 'required|string',
            'answer'     => 'required|string',
        ]);

        $faq = Faq::create($validated);

        if(!$faq){
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Gagal menambahkan data faq!',
            ]);
        }

        return redirect()->route('faq')->with([
            'status' => 'success',
            'message' => 'Berhasil menambahkan data faq!',
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
        $data['data'] = Faq::find($id);
        return view('pages.faq.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question'     => 'required|string',
            'answer'     => 'required|string',
        ]);

        $updated = $faq->update($validated);

        if(!$updated){
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Gagal mengubah data faq!',
            ]);
        }

        return redirect()->route('faq')->with([
            'status' => 'success',
            'message' => 'Berhasil megubah data faq!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);

        $deleted = $faq->delete();

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
