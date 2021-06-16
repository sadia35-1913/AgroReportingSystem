@extends('layouts.backend.app')
@push('title') Report @endpush
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Admin Report</h4>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $user_d->options['chart_title'] }}</h1>
                        {!! $user_d->renderHtml() !!}
                    </div>
                </div>
            </div>
            <!-- /Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $product_d->options['chart_title'] }}</h1>
                        {!! $product_d->renderHtml() !!}
                    </div>
                </div>
            </div>
            <!-- /Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $order_d->options['chart_title'] }}</h1>
                        {!! $order_d->renderHtml() !!}
                    </div>
                </div>
            </div>
            <!-- /Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $order_item_d->options['chart_title'] }}</h1>
                        {!! $order_item_d->renderHtml() !!}
                    </div>
                </div>
            </div>
            <!-- /Column -->
        </div>
        <hr>
        <hr>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $user_m->options['chart_title'] }}</h1>
                        {!! $user_m->renderHtml() !!}
                    </div>
                </div>
            </div>
            <!-- /Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $product_m->options['chart_title'] }}</h1>
                        {!! $product_m->renderHtml() !!}
                    </div>
                </div>
            </div>
            <!-- /Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $order_m->options['chart_title'] }}</h1>
                        {!! $order_m->renderHtml() !!}
                    </div>
                </div>
            </div>
            <!-- /Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $order_item_m->options['chart_title'] }}</h1>
                        {!! $order_item_m->renderHtml() !!}
                    </div>
                </div>
            </div>
            <!-- /Column -->
        </div>

            <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('script')
    {!! $user_m->renderChartJsLibrary() !!}
    {!! $user_m->renderJs() !!}

    {!! $product_m->renderChartJsLibrary() !!}
    {!! $product_m->renderJs() !!}

    {!! $order_m->renderChartJsLibrary() !!}
    {!! $order_m->renderJs() !!}

    {!! $order_item_m->renderChartJsLibrary() !!}
    {!! $order_item_m->renderJs() !!}

    {!! $user_d->renderChartJsLibrary() !!}
    {!! $user_d->renderJs() !!}

    {!! $product_d->renderChartJsLibrary() !!}
    {!! $product_d->renderJs() !!}

    {!! $order_d->renderChartJsLibrary() !!}
    {!! $order_d->renderJs() !!}

    {!! $order_item_d->renderChartJsLibrary() !!}
    {!! $order_item_d->renderJs() !!}
@endpush
