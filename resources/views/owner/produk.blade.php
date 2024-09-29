@extends("layouts.owner")
@section("namaHalaman", "Produk")
@section("namaOperator", "Owner")
@section("judul", "Data produk")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.produk")
@endsection
