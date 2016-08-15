

<style>
ul {
    list-style-type: none;
  
}

.filter li {
    float: left;
    margin-right: 20px;
}


span{
	float:left;
	margin-right:10px;
}

.filter .glyphicon {
	margin-top:7px;
}

</style>
<div class="filter" style="height:30px;">
{!! Form::open([
'method' => 'POST',
'route' => 'TaskList.Filter']) !!}
<ul id="filer-options">


<span class="glyphicon glyphicon-user"></span>

<li>  
{!! Form::select('id', $employees,
            null, 
            ['class' => 'form-control']) !!}</li>

<span class="glyphicon glyphicon-filter"></span>
<li> {!! Form::submit('filter toepassen', 

array('class' => 'btn btn-primary')) !!}
</ul>

{!! Form::close() !!}
</div>
<hr>

