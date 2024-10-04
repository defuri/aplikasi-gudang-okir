@extends("layouts.owner")
@section("namaHalaman", "Pelanggan")
@section("namaOperator", "Owner")
@section("judul", "Data Pelanggan")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.pelanggan")
@endsection
