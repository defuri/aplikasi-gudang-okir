@extends("layouts.owner")
@section("namaHalaman", "Transaksi Bahan Baku")
@section("namaOperator", "Owner")
@section("judul", "Transaksi Bahan Baku")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.transaksiBahanBaku")
@endsection
