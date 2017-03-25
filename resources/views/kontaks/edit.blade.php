@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }} ">Home</a></li>
					<li><a href="{{ url('/sms/kontaks') }}">Kontak</a></li>
					<li class="active">Edit Kontak</li>
				</ul>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Edit Kontak</h2>
					</div>

					<div class="panel-body">
						{!! Form::model($kontak, ['url' => route('kontaks.update', $kontak->id), 'method' => 'put', 'files'=>'true','class'=>'form-horizontal']) !!}
						@include('kontaks._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
	