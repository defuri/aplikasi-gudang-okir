<?php

namespace App\Http\Controllers;

use App\Models\bahanBakuModel;
use App\Models\satuanModel;
use Illuminate\Http\Request;

class CreateTransaksiBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $bahanBaku = bahanBakuModel::all();
        $satuan = satuanModel::all();

        return view('owner.create-transaksi-bahan-baku', compact('bahanBaku', 'satuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request->jumlah);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
