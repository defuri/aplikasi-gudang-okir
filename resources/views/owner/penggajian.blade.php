@extends("layouts.owner")
@section("namaHalaman", "Penggajian")
@section("namaOperator", "Owner")
@section("judul", "Data Penggajian")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.penggajian");
@endsection
