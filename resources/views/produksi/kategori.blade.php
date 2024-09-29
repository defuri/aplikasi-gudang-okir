@extends("layouts.produksiLayout")
@section("namaHalaman", "Kategori")
@section("namaOperator", "Admin Produksi")
@section("judul", "Data Kategori")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.kategori")
@endsection
