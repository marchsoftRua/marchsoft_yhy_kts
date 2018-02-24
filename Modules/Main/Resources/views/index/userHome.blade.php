@extends('main::index.layouts.layout')

@include('main::index.layouts.header')
@include('main::index.layouts.panel')


@section('index')
@endsection
@include('main::index.user.home')

@include('main::index.layouts.footer')
