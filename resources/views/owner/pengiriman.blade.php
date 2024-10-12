@extends("layouts.owner")
@section("namaHalaman", "Pengiriman")
@section("namaOperator", "Owner")
@section("judul", "Data Pengiriman")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.pengiriman")
@endsection
