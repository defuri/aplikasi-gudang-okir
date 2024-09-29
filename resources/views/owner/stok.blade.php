@extends("layouts.owner")
@section("namaHalaman", "Stok")
@section("namaOperator", "Owner")
@section("judul", "Data Stok")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.stok")
@endsection
