@extends('admin.layouts.base')

@section('title', 'Dashboard')

@section('content')
    <style>
        /* style ini untuk dihalaman dashboard membuat tabel tidak ikut di skroll */
        table thead th {
            position: sticky;
            top: 0;
            background-color: #ffffff;
            /* Warna background agar teks tetap terlihat */
            z-index: 2;
            /* Supaya tetap di atas konten tabel */
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            /* Opsional: menambahkan bayangan */
        }

        /* akhir style */
    </style>
    <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @include('admin.dashboard.statistik')
            @include('admin.dashboard.newestBookLoan')
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
