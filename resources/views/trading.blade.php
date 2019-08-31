@extends('layouts.trading-base')

@section('body')
    <div class="col-md-3">
        <tickers></tickers>
        <exchange></exchange>
        <balance></balance>
    </div>
    <div class="col-md-9">
        <panel title="نمودار">
            <div slot="body">
                <div id="tv_chart_container"></div>
            </div>
        </panel>

        <div id="tv_chart_container"></div>
        <order-book></order-book>
        <order-history></order-history>
    </div>
@endsection
