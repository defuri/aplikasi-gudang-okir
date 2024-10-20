@extends("layouts.owner")
@section("namaHalaman", "Tambah Data Penjualan")
@section("namaOperator", "Owner")
@section("judul", "Tambah Data Penjualan")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.create-penjualan")
@endsection
