@extends("layouts.owner")
@section("namaHalaman", "Pack")
@section("namaOperator", "Owner")
@section("judul", "Data Pack")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.pack")
@endsection
