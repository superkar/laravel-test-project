@extends('layouts.app')

@section('title', 'Погода в Брянске')

@section('content')

<div class="col-lg-8 col-lg-offset-2">

    <div class="row text">
        <div class="col-lg-2"><br /><h4>Яndex.Погода</h4></div>
        <div class="col-lg-3 text-right"><h3>Погода в Брянске</h3></div>
        <div class="col-lg-1"><img src="https://yastatic.net/weather/i/icons/blueye/color/svg/{{ $data->fact->icon }}.svg" class="img img-fluid" /></div>
        <div class="col-lg-1"><h3>{{ $data->fact->temp }} &deg;C</h3></div>
        <div class="col-lg-3"><h3>{{ $data->fact->pressure_mm }} мм. рт. ст.</h3></div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-lg-offset-6">Ветер: {{ $data->fact->wind_speed }} м/с (<?=strtoupper($data->fact->wind_dir);?>)</div>
        <div class="col-lg-3">Влажность: {{ $data->fact->humidity }}%</div>
    </div>
 
</div>
 
@endsection


