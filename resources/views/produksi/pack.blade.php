@extends("layouts.produksiLayout")
@section("namaHalaman", "Pack")
@section("namaOperator", "Admin Produksi")
@section("judul", "Data Pack")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.pack")
@endsection
