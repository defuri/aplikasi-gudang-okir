@extends("layouts.owner")
@section("namaHalaman", "Bahan Baku")
@section("namaOperator", "Owner")
@section("judul", "Data Bahan Baku")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.bahanBaku")
@endsection
