@extends("layouts.owner")
@section("namaHalaman", "Data Produk")
@section("namaOperator", "Owner")
@section("judul", "Data Produk Keluar")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.ProdukKeluar")
@endsection
