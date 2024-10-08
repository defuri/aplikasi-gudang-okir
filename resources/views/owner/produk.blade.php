@extends("layouts.owner")
@section("namaHalaman", "Produk")
@section("namaOperator", "Owner")
@section("judul", "Data Produk")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.produk")
@endsection
