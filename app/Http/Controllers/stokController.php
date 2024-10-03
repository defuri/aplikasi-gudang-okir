<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\stokModel;
use App\Models\gudangModel;
use App\Models\produkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class stokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stok = stokModel::orderBy('id', 'asc')->paginate(10);
        $gudang = gudangModel::all();
        $produk = produkModel::all();

        return view('owner.stok', compact('stok', 'gudang', 'produk'));
    }
}
