<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        // $activity = Activity::with('causer')->orderByDesc('id')->limit(10)->get();

        switch ($user->id_hak) {
            case 1:
                $activity = Activity::with('causer')->orderByDesc('id')->paginate(10);
                return view('owner.activity', compact('user', 'activity'));

            case 2:
                $logNames = ['Satuan', 'Suplier', 'Bahan Baku', 'Transaksi Bahan Baku', 'Rasa', 'Kategori', 'Pack', 'Produk'];
                $activity = Activity::with('causer')->whereIn('log_name', $logNames)->latest()->paginate(10);

                return view('owner.activity', compact('user', 'activity'));

            case 3:
                $logNames = ['Gudang', 'Produk masuk', 'Produk Keluar', 'Stok'];
                $activity = Activity::with('causer')->whereIn('log_name', $logNames)->latest()->paginate(10);

                return view('owner.activity', compact('user', 'activity'));

            default:
                # code...
                break;
        }
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
