@extends("layouts.produksiLayout")
@section("namaHalaman", "Satuan")
@section("namaOperator", "Admin Produksi")
@section("judul", "Data Satuan")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.satuan");
@endsection
