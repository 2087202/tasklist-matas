
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

.tasksheader button{
  float:left;
  border: none;
  margin-top:10px;
  background-color: #101e7f;
}

.tasksheader span{
  color:white;
}
</style>

<script>
$(document).ready(function(){

 $("span.glyphicon.glyphicon-chevron-down").click(function(){ 
  var id =  $(this).attr('id');
  $(this).hide();
  $("span.glyphicon.glyphicon-chevron-up").show();
 $('div#tasks'+id).show(300);
});

 $("span.glyphicon.glyphicon-chevron-up").click(function(){ 
  var id =  $(this).attr('id');
  $(this).hide();
  $("span.glyphicon.glyphicon-chevron-down").show();
 $('div#tasks'+id).hide(300);
});

});
</script>

@include('layouts.filter')






@foreach ($lists as $list) 



 
	<div class="listtasks" style="width:500px; ; float:left; margin-bottom:20px; margin-right:20px; position:relative; background-color: #f7f6f6;">
   <div class="user" style="width:500px; background-color:white;">
  <span class="glyphicon glyphicon-list"></span><p style="text-align:center">Werknemer: {{$list->employee_id}}</p>
</div>
	<div class="tasksheader" style="border-bottom:1px solid; background-color: #101e7f;">
          {!! Form::model(
      $list,
    [
      'route' => ['TaskList.destroy', $list->id], 
      'method' => 'delete', 
      'class' => 'form'
    ]) 
!!}
  {!! Form::hidden('id',$list->id) !!}
{!! Form::button('<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit']) !!}
{!! Form::close() !!}


    <h3 style="color: white; text-align: center;">{{$list->name}}</h3>
    </div>
      <div class="taskwrapper" style="padding:10px">
  
<div class="tasknotifications" style="height: 40px;
    padding-left: 50px;">
<span class="label label-primary">Taken: {{$tasks->getTasks($list)->count()}}</span>
<span class="glyphicon glyphicon-chevron-down" id="{{$list->id}}"></span>
<span class="glyphicon glyphicon-chevron-up" id="{{$list->id}}" style="display: none;" id="{{$list->id}}"></span>
   <hr>
      </div>
   





 @foreach($tasks->getTasks($list)  as $task)
 <div class="tasks" id="tasks{{$list->id}}" style="background-color:white; height: 40px; padding-top:5px; margin-bottom:10px; display:none;">
 <ul>
 <li>
  {{$task->content}}
 </li>
 @if($task->completed_at == null)


@else

<span class="glyphicon glyphicon-ok" style="color: green;"></span> <p style="font-size: 12px;">afgerond op: {{$task->completed_at}}</p>

@endif





</div>
  @endforeach

    
  
</div>
<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: @{{value}}">
    <span class="sr-only">45% Complete</span>
  </div>
</div>

<script>
new Vue({
    el: 'body',
    data: {
        tasks: '{{$tasks->getTasks($list)->count() / 100}}',
        completedTasks: '{{$tasks->getCompletedTasks($list)}}'
        
    },
    computed: {
      value:function() {
        return this.completedTasks / this.tasks + "%"
      },

      

    }
})
</script>

</div>

</div>
@endforeach



@stop

