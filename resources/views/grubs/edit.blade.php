@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
				<li><a href="{{ url('/home') }} ">Dashboard</a></li>
				<li><a href="{{ url('/sms/grubs') }}">Grup</a></li>
				<li class="active">Edit Grup</li>
				</ul>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Edit Grup</h2>
					</div>

					<div class="panel-body">
						{!! Form::model($grub, ['url' => route('grubs.update', $grub->id), 'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}
						@include('grubs._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
	