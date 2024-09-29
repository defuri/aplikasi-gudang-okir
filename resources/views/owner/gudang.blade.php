@extends("layouts.owner")
@section("namaHalaman", "Gudang")
@section("namaOperator", "Owner")
@section("judul", "Data Gudang")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.gudangCRUD")
@endsection
