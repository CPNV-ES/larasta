@extends ('layout') 
@section ('content')

<div class="row">
	<div class="container">
		<h1>Synchronisation avec l'intranet</h1>
	</div>
</div>
<h2>Classes</h2>
<blockquote>
	Cliquez sur les différentes personnes que vous souhaitez synchroniser, le bouton devient alors vert.
</blockquote>
@foreach ($students as $class=>$classInformation)
	<fieldset class="flocks">
		<legend>{{$class}}</legend>	
		<label>Maître de classe</label>
		<div class="teachers">
			<div class="onefilter">
				<input type="checkbox" id="{{$class}}{{$teachers[$class]["teacher_id"]}}">
				<label for="{{$class}}{{$teachers[$class]["teacher_id"]}}">{{$teachers[$class]["name"]}}</label>
			</div>
		</div>
		<label>Élèves</label>
		<div class="students">
			@foreach ($classInformation as $key => $student)				
				<div class="onefilter">
					<input type="checkbox" id="{{$class}}{{$student["id"]}}">
					<label for="{{$class}}{{$student["id"]}}">{{$student["name"]}}</label>
				</div>
			@endforeach
		</div>
	</fieldset>
@endforeach

@stop

@push ('page_specific_js')
    <script src="/js/synchro.js"></script>
@endpush

@push ('page_specific_css')
	<link rel="stylesheet" href="/css/synchro.css">
@endpush
