@extends('layouts.default')

@section('navbar')

    @include('sections.navbar')

@endsection

@section('body')

    @if(isset($weatherPage) && $weatherPage === 1)
        @include('sections.weather')
    @elseif(isset($ordersListPage)  && $ordersListPage === 1)
        @include('sections.ordersList')
    @elseif(isset($orderPage)  && $orderPage === 1)
        @include('sections.order')
    @elseif(isset($productsPage)  && $productsPage === 1)
        @include('sections.products')
    @elseif(isset($newOrdersListPage)  && $newOrdersListPage === 1)
        @include('sections.newOrdersList')
    @else
        @include('sections.index')
    @endif

@endsection

