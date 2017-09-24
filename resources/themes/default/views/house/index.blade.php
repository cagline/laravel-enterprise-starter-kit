@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
@endsection

@section('content')
<!-- @var $houses house -->
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-university"></i> Manage House </h3>
                <div class="box-tools pull-right">

                    <a href="{{ url('/house/create') }}" class="btn btn-primary" ><i class="fa fa-plus"></i> Add House</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>House Size</th>
                        <th>House Size</th>
                        <th>Sold</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    @foreach($houses as $house)
                    <tr>
                        <td>{{ $house->id}}</td>
                        <td><a href="{{ url('/house/'.$house->id.'/edit') }}" >{{ $house->title}}</a></td>
                        <td>{{ $house->city->name_en}}</td>
                        <td>{{ $house->address}}</td>
                        <td>{{ $house->house_size}}</td>
                        <td>{{ $house->land_size}}</td>
                        <td>
                            @if ($house->sold)<small class="label pull-right bg-green">Sold</small>
                            @else <small class="label pull-right bg-red">Unsold</small>@endif
                        </td>
                        <td class="text-nowrap">{{ date('Y/m/d, H:i', strtotime($house->created_at)) }}</td>
                        <td class="text-nowrap">{{ date('Y/m/d, H:i', strtotime($house->updated_at)) }}</td>
                    </tr>
                    @endforeach
                </table>
					<div class="col-xs-12">{!! $houses->render() !!}</div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

@endsection
