@extends("layouts.owner")
@section("namaHalaman", "Tambah Data Produk Masuk")
@section("namaOperator", "Owner")
@section("judul", "Tambah Data Produk Masuk")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.create-produk-masuk")
@endsection
