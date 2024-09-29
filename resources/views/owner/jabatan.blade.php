@extends("layouts.owner")
@section("namaHalaman", "Jabatan")
@section("namaOperator", "Owner")
@section("judul", "Data Jabatan")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.jabatan");
@endsection
