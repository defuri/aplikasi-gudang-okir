@extends("layouts.produksiLayout")
@section("namaHalaman", "Bahan Baku")
@section("namaOperator", "Admin Produksi")
@section("judul", "Data Bahan Baku")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.bahanBaku")
@endsection
