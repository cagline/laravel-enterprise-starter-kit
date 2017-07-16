@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
@endsection

@section('content')
<!-- @var $lands land -->
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-university"></i> Manage Land </h3>
                <div class="box-tools pull-right">

                    <a href="{{ url('/land/create') }}" class="btn btn-primary" ><i class="fa fa-plus"></i> Add Land</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Land Size</th>
                        <th>Sold</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    @foreach($lands as $land)
                    <tr>
                        <td>{{ $land->id}}</td>
                        <td><a href="{{ url('/land/'.$land->id.'/edit') }}" >{{ $land->title}}</a></td>
                        <td>{{ $land->city->name_en}}</td>
                        <td>{{ $land->address}}</td>
                        <td>{{ $land->land_size}}</td>
                        <td>
                            @if ($land->sold)<small class="label pull-right bg-green">Sold</small>
                            @else <small class="label pull-right bg-red">Unsold</small>@endif
                        </td>
                        <td>{{ $land->created_at}}</td>
                        <td>{{ $land->updated_at}}</td>
                    </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

@endsection
