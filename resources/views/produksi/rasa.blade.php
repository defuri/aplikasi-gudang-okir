@extends("layouts.produksiLayout")
@section("namaHalaman", "Rasa")
@section("namaOperator", "Admin Produksi")
@section("judul", "Data Rasa")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.rasa")
@endsection
