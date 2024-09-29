@extends("layouts.owner")
@section("namaHalaman", "Data Produk Keluar Gudang")
@section("namaOperator", "Owner")
@section("judul", "Data Produk Keluar Gudang")

@section("content")
    @include("layouts.breadcrumb")
    @include("CRUD.ProdukKeluar")
@endsection
