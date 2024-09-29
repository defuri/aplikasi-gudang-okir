@extends("layouts.owner")
@section("namaHalaman", "Penjualan")
@section("namaOperator", "Owner")
@section("judul", "Data Penjualan")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.penjualan")
@endsection
