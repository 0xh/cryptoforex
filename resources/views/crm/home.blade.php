@extends('crm.layout')
@section('content')
    @include('crm.customers')
    @include('crm.deals')
    @include('crm.instruments')
    @include('crm.other')
@endsection
@include('crm.popup')
