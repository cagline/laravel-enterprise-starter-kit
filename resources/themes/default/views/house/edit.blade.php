@extends('layouts.master')

@section('head_extra')
<!-- Select2 css -->
@include('partials._head_extra_select2_css')
@endsection

@section('content')
<!-- @var $this landController --> 
<!-- @var $house house -->  
<div class="row">
    <div class="col-md-12">
        <div class="box box-default" >
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-university"></i> Edit - {{$house->title}}</h3>
            </div>
            <div class="box-body"> 

                {!! Form::model($house,['url'=>'house/'.$house->id, 'method'=>'PATCH', 'enctype'=>'multipart/form-data']) !!}
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('title', 'Title', ['class'=>'required']) !!}
                        {!! Form::text('title', null, ['id' => 'title', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                        @if ($errors->has('title'))<p class="text-danger">{!!$errors->first('title')!!}</p>@endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description', ['class'=>'required']) !!}
                        {!! Form::textarea('description', null, ['id' => 'description', 'class'=>'form-control', 'placeholder' => 'Description']) !!}
                        @if ($errors->has('description'))<p class="text-danger">{!!$errors->first('title')!!}</p>@endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('city_id', 'City', ['class'=>'required']) !!}
                        {!! Form::select('city_id', $cities, null,  ['id' => 'city_id', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                        @if ($errors->has('city_id'))<p class="text-danger">{!!$errors->first('city_id')!!}</p>@endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', 'Address', ['class'=>'required']) !!}
                        {!! Form::text('address', null, ['id' => 'address', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                        @if ($errors->has('address'))<p class="text-danger">{!!$errors->first('address')!!}</p>@endif
                    </div>
                    <div class="row">
                        
                        <div class="form-group col-md-6">
                            {!! Form::label('house_size', 'House Size', ['class'=>'required']) !!}
                            {!! Form::number('house_size', null, ['id' => 'house_size', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('house_size'))<p class="text-danger">{!!$errors->first('house_size')!!}</p>@endif
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('land_size', 'Land Size', ['class'=>'required']) !!}
                            {!! Form::number('land_size', null, ['id' => 'land_size', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('land_size'))<p class="text-danger">{!!$errors->first('land_size')!!}</p>@endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('bed_rooms', 'Bed rooms', ['class'=>'required']) !!}
                            {!! Form::number('bed_rooms', null, ['id' => 'bed_rooms', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('bed_rooms'))<p class="text-danger">{!!$errors->first('bed_rooms')!!}</p>@endif
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('bath_rooms', 'Bath rooms', ['class'=>'required']) !!}
                            {!! Form::number('bath_rooms', null, ['id' => 'bath_rooms', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('bath_rooms'))<p class="text-danger">{!!$errors->first('bath_rooms')!!}</p>@endif
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('other_rooms', 'Other rooms', ['class'=>'required']) !!}
                            {!! Form::number('other_rooms', null, ['id' => 'other_rooms', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('other_rooms'))<p class="text-danger">{!!$errors->first('other_rooms')!!}</p>@endif
                        </div>
                    </div>
                    <div class="form-group">
                            {!! Form::label('price', 'Price', ['class'=>'required']) !!}
                            {!! Form::number('price', null, ['id' => 'price', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('price'))<p class="text-danger">{!!$errors->first('type')!!}</p>@endif
                    </div>
                    <div class="form-group">
                        <div class="radio">
                            <label>
                            {!! Form::radio('type', $typeHouse , $house->type == $typeHouse)  !!}
                            House
                            </label>
                            
                        </div>                        
                        <div class="radio">
                            <label>
                            {!! Form::radio('type', $typeConstruction , $house->type ==$typeConstruction)  !!}
                            Construction
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                            {!! Form::radio('type', $typeOnGoing , $house->type ==$typeOnGoing)  !!}
                            On Going Construction
                            </label>
                        </div>
                       
                    </div>
<!--                    <div class="form-group">
                        {!! Form::label('map', 'Map Link', ['class'=>'required']) !!}
                        {!! Form::text('map', null, ['id' => 'map', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                        @if ($errors->has('map'))<p class="text-danger">{!!$errors->first('map')!!}</p>@endif
                    </div>-->
                    <div class="form-group">
                        {!! Form::label('sold', 'Sold', ['class'=>'required']) !!}
                        {!! Form::hidden('sold', 0) !!}
                        {!! Form::checkbox('sold', 1, $house->isSold(), ['id' => 'sold', 'class'=>'checkbox', 'placeholder' => 'Sold']) !!}
                        @if ($errors->has('sold'))<p class="text-danger">{!!$errors->first('sold')!!}</p>@endif
                    </div> 
                </div> 
                <div class="col-md-6">
                    <div class="row"> 
                        <?php for ($i = 1; $i <= 8; $i++) { ?> 
                            @if(object_get($house,"image{$i}"))
                            <div  class="col-md-6">
                                <div class="form-group image-upload-thum">
                                    {!! Form::label('image'.$i, 'Image '.$i) !!} 
                                    <img src="{{ url('../storage/app/'. object_get($house, "image{$i}" )) }}" alt="Shop Image1" class="img-responsive img-rounded"/>
                                    <div style="height: 58px;">
                                    <a class="btn btn-link" role="button" data-toggle="collapse" href="#image{{$i}}-uploader">change image {{$i}}</a>
                                    <div class="collapse" id="image{{$i}}-uploader">
                                        {!! Form::file('image'.$i, null, ['id' => 'image'.$i, 'class'=>'form-control']) !!}                                
                                    </div>
                                    </div>

                                    @if ($errors->has('image'.$i))<p class="text-danger">{!!$errors->first('image'.$i)!!}</p>@endif
                                </div>
                            </div>
                            @endif
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::submit('Update House', ['id' => 'photo', 'class'=>'btn btn-primary pull-right']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['house.destroy', $house->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete House', ['id' => 'photo', 'class'=>'btn btn-danger pull-right', 'style'=>'margin-right: 10px;']) !!}
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('body_bottom')

<!-- Select2 4.0.0 -->
<script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("#city_id").select2();
});
</script>

@endsection
