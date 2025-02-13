@extends('superadmin.layouts.base')

@section('title', 'Dashboard')


@section('content')
    <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @include('superadmin.dashboard.newestBookLoan')
            @include('superadmin.dashboard.statistik')
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
