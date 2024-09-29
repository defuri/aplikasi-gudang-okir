@extends("layouts.owner")
@section("namaHalaman", "Rasa")
@section("namaOperator", "Owner")
@section("judul", "Data Rasa")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.rasa")
@endsection
