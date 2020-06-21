@extends ('layout') 
@section ('content')

<div class="row">
	<div class="container">
		<h1>Synchronisation avec l'intranet</h1>
	</div>
</div>
<h2>Classes</h2>
<blockquote>
	Cliquez sur les différentes personnes que vous souhaitez synchroniser, le bouton devient alors vert.<br/>
	Inversémment pour ne pas les mettre à jour.<br/><br/>
	Si vous ne souhaitez pas synchroniser un enseignant, pensez à vérifier qu'il ne soit pas dans plusieurs classes...
</blockquote>
<form action="{{route('synchro.store')}}" method="post">
	@csrf
	@foreach ($classes as $class => $classInformations)
		<fieldset class="flocks">
			<legend>{{$class}}</legend>	
			<label>Maître de classe</label>
			<div class="teachers">
				<div class="onefilter">
					<input type="checkbox" id="{{$class}}-{{$classInformations["teacher"]["friendly_id"]}}" name="{{$classInformations["teacher"]["friendly_id"]}}[status]" checked>
					<label for="{{$class}}-{{$classInformations["teacher"]["friendly_id"]}}">{{$classInformations["teacher"]["name"]}}</label>
					<input type="hidden" name="{{$classInformations["teacher"]["friendly_id"]}}[friendly_id]" value="{{$classInformations["teacher"]["friendly_id"]}}">
					<input type="hidden" name="{{$classInformations["teacher"]["friendly_id"]}}[occupation]" value="{{$classInformations["teacher"]["occupation"]}}">
				</div>
			</div>
			<label>Élèves</label>
			<div class="students">
				@foreach ($classInformations["students"] as $student)	
					<div class="onefilter">
						<input type="checkbox" id="{{$class}}-{{$student["friendly_id"]}}" name="{{$student["friendly_id"]}}[status]" checked>
						<label for="{{$class}}-{{$student["friendly_id"]}}">{{$student["name"]}}</label>
						<input type="hidden" name="{{$student["friendly_id"]}}[friendly_id]" value="{{$student["friendly_id"]}}">
						<input type="hidden" name="{{$student["friendly_id"]}}[occupation]" value="{{$student["occupation"]}}">
					</div>
				@endforeach
			</div>
		</fieldset>
	@endforeach
	<button type="submit">
		Enregistrer
	</button>
</form>
@stop

@push ('page_specific_js')
    <script src="/js/synchro.js"></script>
@endpush

@push ('page_specific_css')
	<link rel="stylesheet" href="/css/synchro.css">
@endpush
