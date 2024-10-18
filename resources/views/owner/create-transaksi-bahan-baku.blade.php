@extends("layouts.owner")
@section("namaHalaman", "Tambah Transaksi Bahan Baku")
@section("namaOperator", "Owner")
@section("judul", "Tambah Transaksi Bahan Baku")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.create-transaksi-bahan-baku")
@endsection
