@extends('app')

@section('content')
    <div id="report_app">
        <div class="title m-b-md">
            Reports
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    @foreach($report_list as $report)
                        <button type="button" v-on:click="loadStructure({{ $report->id }})" class="btn btn-success m-1">{{ $report->name }}</button>
                    @endforeach
                </div>
                <!--div class="col-sm-6" v-html="$store.state.structure.data" id="reports"></div-->
                <div class="col-sm-6" id="reports">
                    <report_list></report_list>
                </div>
                <div class="col-sm-3">
                    <button type="button" v-on:click="setPeriod(null);" class="btn btn-primary m-1">Default</button>
                    <button type="button" v-on:click="setPeriod('last_hour');" class="btn btn-primary m-1">Last hour</button>
                    <button type="button" v-on:click="setPeriod('3_hour');" class="btn btn-primary m-1">3 hour</button>
                    <button type="button" v-on:click="setPeriod('1_day');" class="btn btn-primary m-1">Last day</button>
                    <button type="button" v-on:click="setPeriod('2019-05-01 00:00:00', '2019-05-10 00:00:00');" class="btn btn-primary m-1">10 days</button>
                </div>
            </div>
        </div>
        <div class="links">
            <a href="/">Back</a>
        </div>
    </div>
@endsection