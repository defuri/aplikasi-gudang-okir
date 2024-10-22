@extends("layouts.owner")
@section("namaHalaman", "Bahan Baku")
@section("namaOperator", "Produksi")
@section("judul", "Data Bahan Baku")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.bahanBaku")
@endsection
