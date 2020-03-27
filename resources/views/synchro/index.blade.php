@extends ('layout') 
@section ('content')

<div class="row">
	<div class="">
		<h1>Synchronisation</h1>
	</div>
</div>
<div class="row">
	<div class="alert alert-info messageLoading">
		<h4>Veuillez patienter</h4>
	</div>
</div>
<form method="POST" action="/synchro/modify" class="formModify">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-lg-1 col-md-2 col-xl-2 col-md-offset-2 col-lg-offset-4 col-offset-xl-2 modify-buttons">
			<button name="modify" class="btn btn-danger" type="submit" value="delete">Delete</button>
		</div>
		<div class="col-lg-1 col-lg-offset-1 modify-buttons">
			<button class="btn btn-link selectDelete">Uncheck All</button>
		</div>
		<div class="col-lg-1 col-md-2 col-xl-2 col-md-offset-2 col-lg-offset-1 col-offset-xl-2 modify-buttons">
				<button name="modify" class="btn btn-info" type="submit" value="add">Add</button>
		</div>
		<div class="col-lg-1 col-lg-offset-1 modify-buttons">
			<button class="btn btn-link selectAdd">Uncheck All</button>
		</div>
	</div>
		<div class="row">
			<div class="col-md-2 col-lg-2 col-xl-2 col-md-offset-1 col-lg-offset-1 col-offset-xl-1">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">Nom</th>
						</tr>
					</thead>
					<tbody>
						@foreach($goodStudents as $key => $student)
						<tr class="success">
							<td>{{ $student->lastname . " " . $student->firstname }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="col-md-2 col-lg-3 col-xl-2 col-md-offset-2 col-lg-offset-1 col-offset-xl-2">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">Nom</th>
						</tr>
					</thead>
					<tbody>
						@foreach($obsoleteStudents as $key => $student)
						<tr class="danger">
							<td>{{ $student->lastname . " " . $student->firstname }}</td>
							<td><input type="checkbox" name="deleteCheck[]" value="{{ $student->intranetUserId }}" checked></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="col-md-2 col-lg-3 col-xl-2 col-md-offset-2 col-lg-offset-1 col-offset-xl-2">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">Nom</th>
						</tr>
					</thead>
					<tbody>
						@foreach($newStudents as $key => $student)
						<tr class="info">
							<td>{{ $student['lastname'] . " " . $student['firstname'] }}</td>
							<td><input type="checkbox" name="addCheck[]" value="{{ $key }}" checked></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</form>


@stop

@push ('page_specific_js')
    <script src="/js/synchro.js"></script>
@endpush

@push ('page_specific_css')
	<link rel="stylesheet" href="/css/synchro.css">
@endpush
