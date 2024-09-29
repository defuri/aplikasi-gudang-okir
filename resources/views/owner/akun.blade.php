@extends("layouts.owner")
@section("namaHalaman", "Akun")
@section("namaOperator", "Owner")
@section("judul", "Data Akun")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.akun");
@endsection
