@extends("layouts.produksiLayout")
@section("namaHalaman", "Suplier")
@section("namaOperator", "Admin Produksi")
@section("judul", "Data Suplier")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.suplier")
@endsection
