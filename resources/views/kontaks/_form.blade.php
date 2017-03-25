<div class="form-group{{ $errors->has('panggilan') ? ' has-error' : '' }}">
	{!! Form::label('panggilan', 'Panggilan', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('panggilan', null, ['class'=>'form-control']) !!}
		{!! $errors->first('panggilan', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
	{!! Form::label('nama', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama', null, ['class'=>'form-control','required']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('nomor_hp') ? ' has-error' : '' }}">
	{!! Form::label('nomor_hp', 'Nomor HP', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::number('nomor_hp', null, ['class'=>'form-control','required']) !!}
		{!! $errors->first('nomor_hp', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
	{!! Form::label('alamat', 'alamat', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::textArea('alamat', null, ['class'=>'form-control']) !!}
		{!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>
