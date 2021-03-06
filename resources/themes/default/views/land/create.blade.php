@extends('layouts.master')

@section('head_extra')
<!-- Select2 css -->
@include('partials._head_extra_select2_css')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default" >
            <div class="box-header with-border">
                <h3 class="box-sold"><i class="fa fa-university"></i> Create Land</h3>
            </div>
            <div class="box-body"> 

                {!! Form::open(['url'=>'land', 'enctype'=>'multipart/form-data']) !!}
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('title', 'Title', ['class'=>'required']) !!}
                        {!! Form::text('title', null, ['id' => 'title', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                        @if ($errors->has('title'))<p class="text-danger">{!!$errors->first('title')!!}</p>@endif
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
                            {!! Form::label('land_size', 'Land Size', ['class'=>'required']) !!}
                            {!! Form::number('land_size', null, ['id' => 'land_size', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('land_size'))<p class="text-danger">{!!$errors->first('land_size')!!}</p>@endif
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('house_size', 'House Size', ['class'=>'required']) !!}
                            {!! Form::number('house_size', null, ['id' => 'house_size', 'class'=>'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('house_size'))<p class="text-danger">{!!$errors->first('house_size')!!}</p>@endif
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
                            {!! Form::radio('type', $typeLand , true)  !!}
                            Land
                            </label>
                        </div>                        
                        <div class="radio">
                            <label>
                            {!! Form::radio('type', $typeServey , false)  !!}
                            Land Servey
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                            {!! Form::radio('type', $typeOnGoing , false)  !!}
                            On Going Land Servey
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
                        {!! Form::checkbox('sold', 1, null, ['id' => 'sold', 'class'=>'checkbox', 'placeholder' => 'Sold']) !!}
                        @if ($errors->has('sold'))<p class="text-danger">{!!$errors->first('sold')!!}</p>@endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <?php for ($i = 1; $i <= 8; $i++) { ?> 

                            <div  class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('image1', 'Image '.$i) !!}
                                    {!! Form::file('image'.$i, null, ['id' => 'image'.$i, 'class'=>'form-control']) !!}
                                    @if ($errors->has('image'.$i))<p class="text-danger">{!!$errors->first('image'.$i)!!}</p>@endif
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::submit('Create Land', ['id' => 'photo', 'class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}    
            </div>
            <div class="box-footer"></div>
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
