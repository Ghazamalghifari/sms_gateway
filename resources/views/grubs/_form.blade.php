<div class="form-group{{ $errors->has('nama_grub') ? ' has-error' : '' }}">
	{!! Form::label('nama_grub', 'Nama Grup', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			{!! Form::text('nama_grub', null, ['class'=>'form-control']) !!}
			{!! $errors->first('nama_grub', '<p class="help-block">:message</p>') !!}
		</div> 
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
</div> 