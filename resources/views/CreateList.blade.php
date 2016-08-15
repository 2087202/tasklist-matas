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

</div>


@stop

?>