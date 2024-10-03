@extends("layouts.owner")
@section("namaHalaman", "Data Produk Masuk")
@section("namaOperator", "Owner")
@section("judul", "Data Produk Masuk")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.ProdukMasuk")
@endsection
