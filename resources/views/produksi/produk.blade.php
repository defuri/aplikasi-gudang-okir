@extends("layouts.produksiLayout")
@section("namaHalaman", "Produk")
@section("namaOperator", "Admin Produksi")
@section("judul", "Data produk")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.produk")
@endsection
