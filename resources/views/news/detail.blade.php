@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">{{ $new->title }}</div>
				<div class="card-body">
					<p>{{ $new->summary }}</p>
					<p>{!! $new->content !!}</p>
				</div>
			</div>
		</div>
	</div>
@endsection