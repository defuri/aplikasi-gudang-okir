@extends("layouts.owner")
@section("namaHalaman", "Pesanan")
@section("namaOperator", "Owner")
@section("judul", "Data Pesanan")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.pesanan");
@endsection
