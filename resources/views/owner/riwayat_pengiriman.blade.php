@extends("layouts.owner")
@section("namaHalaman", "Riwayat Pengiriman")
@section("namaOperator", "Owner")
@section("judul", "Riwayat Pengiriman")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.riwayat_pengiriman")
@endsection
