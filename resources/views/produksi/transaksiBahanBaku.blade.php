@extends("layouts.produksiLayout")
@section("namaHalaman", "Transaksi Bahan Baku")
@section("namaOperator", "Admin Produksi")
@section("judul", "Transaksi Bahan Baku")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.transaksiBahanBaku")
@endsection
