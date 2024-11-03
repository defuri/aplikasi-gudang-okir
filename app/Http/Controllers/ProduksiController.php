<?php

namespace App\Http\Controllers;

use App\Models\bahanBakuModel;
use App\Models\produkModel;
use App\Models\suplier;
use App\Models\transaksiBahanBakuModel;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $totalProduk = count(produkModel::all());
        $totalBahanBaku = count(bahanBakuModel::all());
        $totalSuplier = count(suplier::all());
        $totalTransaksi = count(transaksiBahanBakuModel::all());
        $transaksiBahanBaku = transaksiBahanBakuModel::orderByDesc('id')->get();

        return view('produksi.index', compact('totalProduk', 'totalBahanBaku', 'totalSuplier', 'totalTransaksi', 'transaksiBahanBaku'));
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
