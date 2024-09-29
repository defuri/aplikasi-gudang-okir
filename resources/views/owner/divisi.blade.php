@extends("layouts.owner")
@section("namaHalaman", "Divisi")
@section("namaOperator", "Owner")
@section("judul", "Data Divisi")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.divisi");
@endsection
