@extends("layouts.owner")
@section("namaHalaman", "Suplier")
@section("namaOperator", "Owner")
@section("judul", "Data Suplier")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.suplier")
@endsection
