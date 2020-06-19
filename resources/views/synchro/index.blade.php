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
@foreach ($classes as $class => $classInformations)
	<fieldset class="flocks">
		<legend>{{$class}}</legend>	
		<label>Maître de classe</label>
		<div class="teachers">
			<div class="onefilter">
				<input type="checkbox" id="{{$class}}{{$classInformations["teacher"]["id"]}}">
				<label for="{{$class}}{{$classInformations["teacher"]["id"]}}">{{$classInformations["teacher"]["name"]}}</label>
			</div>
		</div>
		<label>Élèves</label>
		<div class="students">
			@foreach ($classInformations["students"] as $student)	
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
