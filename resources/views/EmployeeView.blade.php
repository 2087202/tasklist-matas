
<?
@extends('layouts.layouts')

@section('title')

@inject('tasks', 'App\Http\Controllers\TaskController')

Admin Matas takenlijst

@stop

@section('body')

<style>
.tasknotifications span{
  float:left;
}

.tasks li:first-child{
  float:left;
}

.tasks li {
  float:right;
  list-style-type: none;
  margin-right:10px;
  margin-bottom:10px;
}

.tasks, .addtask{
-webkit-box-shadow: -3px 5px 5px -6px rgba(0,0,0,0.75);
-moz-box-shadow: -3px 5px 5px -6px rgba(0,0,0,0.75);
box-shadow: -3px 5px 5px -6px rgba(0,0,0,0.75);
}



</style>

<script>
$(document).ready(function(){

 $(".addtask p").click(function(){ 
  var id =  $(this).attr('id');
 $('.'+id).show(300);
});

});
</script>




@foreach ($lists as $list) 

	<div class="listtasks" style="width:500px; ; float:left; margin-bottom:20px; margin-right:20px; position:relative; background-color: #f7f6f6;">
	<div class="tasksheader" style="border-bottom:1px solid; background-color: #101e7f;">
    <h3 style="color: white; text-align: center;">{{$list->name}}</h3>
    </div>
      <div class="taskwrapper" style="padding:10px">
    <div class="addtask" style="background-color:white; height: 40px; padding-top:10px;">
    {!! Form::open(['route' => 'Task.store']) !!}
     <ul>
     <li>  <span class="glyphicon glyphicon-plus-sign"></span></li>
     <li> <p id ="{{$list->id}}">Voeg taak toe</p>
     </li>
  </ul>
    </div>
    <div class="{{$list->id}}" id="{{$list->id}}" style="display: none; height: 40px;">
      {!! Form::text('content', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Taak content',
              'style' => 'float: left; width: 70%'))
   !!}
   {!! Form::hidden('id', $list->id) !!}
     {!! Form::submit('voeg toe', 
      array('class' => 'form-control',
            'style' => 'float: left; width: 30%; background-color: #337ab7; color: white')) !!}
  {!! Form::close() !!}
  </div>
<div class="tasknotifications" style="height: 40px;
    padding-left: 50px;">
<span class="label label-primary">Taken: {{$tasks->getTasks($list)->count()}}</span>
   <hr>
      </div>
   

    



 @foreach($tasks->getTasks($list)  as $task)
 <div class="tasks" style="background-color:white; height: 40px; padding-top:5px; margin-bottom:10px">
 <ul>
 <li>
  {{$task->content}}
 </li>
 @if($task->completed_at == null)
 <li>
      {!! Form::model(
      $task,
    [
      'route' => ['Task.update', $task->id], 
      'method' => 'put', 
      'class' => 'form'
    ]) 
!!}
  {!! Form::hidden('id',$task->id) !!}
{!! Form::button('<span style="color:green" class="glyphicon glyphicon-ok-circle"></span>Afronden', ['type' => 'submit',
                                                                                  'style' => 'background-color:white; border: none']) !!}
{!! Form::close() !!}

   </li>
          <li>
           {!! Form::model(
      $task,
    [
      'route' => ['Task.destroy', $task->id], 
      'method' => 'delete', 
      'class' => 'form'
    ]) 
!!}
  {!! Form::hidden('id',$task->id) !!}
{!! Form::button('<span style="color:#a94141" class="glyphicon glyphicon-remove-circle"></span>Verwijderen', ['type' => 'submit',
                                                                                         'style' => 'background-color:white; border: none']) !!}
{!! Form::close() !!}
</li>

@else

<span class="glyphicon glyphicon-ok" style="color: green;"></span>

@endif





</div>
  @endforeach

    
  
</div>
</div>
</div>
@endforeach




@stop

