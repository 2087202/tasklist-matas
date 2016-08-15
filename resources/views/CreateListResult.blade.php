<?
@extends('layouts.layouts')

@section('title')

Admin Matas takenlijst

@stop

@section('body')

<div class="list-form" style="float:left; width:250px; margin-top:50px;">

{!! Form::open(['route' => 'TaskList.store']) !!}

{!! Form::label('listname','Lijst naam')!!}
{!! Form::text('name', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Lijst naam'))
	 !!} 
<br>
 {!! Form::label('Werknemer') !!}
    {!! Form::select('category', $employees, 
            null, 
            ['class' => 'form-control']) !!}
   <br>




{!! Form::submit('Aanmaken', 
	 array('class'=>'btn btn-primary')) !!}

{!! Form::close() !!}

@if($status) 
	<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span>Lijst toegevoegd</div>


@else

<div class="alert alert-warning" role="alert" style=" padding: 8px; margin-top: 10px;"><span class="glyphicon glyphicon-remove"></span>Lijst kan niet worden toegevoegd</div>
@endif

</div>


@stop

?>