@extends("layouts.owner")
@section("namaHalaman", "Karyawan")
@section("namaOperator", "Owner")
@section("judul", "Data Karyawan")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.karyawan");
@endsection
