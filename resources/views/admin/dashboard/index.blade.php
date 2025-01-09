@extends('admin.layouts.base')

@section('title', 'Dashboard')

@section('content')
    <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            @include('admin.dashboard.statistik')
            @include('admin.dashboard.newestBookLoan')
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
