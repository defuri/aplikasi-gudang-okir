@extends("layouts.owner")
@section("namaHalaman", "Hak")
@section("namaOperator", "Owner")
@section("judul", "Data Hak")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.hak");
@endsection
