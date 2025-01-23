@extends('superadmin.layouts.base')

@section('title', 'Dashboard')


@section('content')
    <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @include('superadmin.dashboard.statistik')
            @include('superadmin.dashboard.newestBookLoan')
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
