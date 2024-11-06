<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\suplier;
use App\Models\stokModel;
use App\Models\produkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $totalProduk = produkModel::count();
        $stokMenipis = stokModel::where('stok', '<', 1000)
            ->select('id_produk', DB::raw('SUM(stok) as stok'))
            ->groupBy('id_produk')
            ->get();
        $totalSuplier = suplier::count();
        $totalUser = User::count();
        $activity = Activity::with('causer')->orderByDesc('id')->limit(10)->get();

        return view('owner.index', compact('totalProduk', 'stokMenipis', 'totalSuplier', 'totalUser', 'activity'));
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
