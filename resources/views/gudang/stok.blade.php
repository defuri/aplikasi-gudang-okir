@extends('layouts.gudangLayout')
@section('namaHalaman', 'Data Stok')
@section('namaOperator', 'Admin Gudang')
@section('judul', 'Data Stok')

@section('content')
    @include('layouts.breadcrumb')
    @include('CRUD.stok')
@endsection
