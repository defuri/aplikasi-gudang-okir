@extends('layouts.gudangLayout')
@section('namaHalaman', 'Data Gudang')
@section('namaOperator', 'Admin Gudang')
@section('judul', 'Data Gudang')

@section('content')
    @include('layouts.breadcrumb')
    @include('CRUD.gudangCRUD')
@endsection
