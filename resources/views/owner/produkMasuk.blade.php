@extends("layouts.owner")
@section("namaHalaman", "Data Produk Masuk Gudang")
@section("namaOperator", "Owner")
@section("judul", "Data Produk Masuk Gudang")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.ProdukMasuk")
@endsection
