@extends("layouts.owner")
@section("namaHalaman", "Satuan")
@section("namaOperator", "Owner")
@section("judul", "Data Satuan")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.satuan");
@endsection
