@extends("layouts.owner")
@section("namaHalaman", "Kategori")
@section("namaOperator", "Owner")
@section("judul", "Data Kategori")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.kategori")
@endsection
