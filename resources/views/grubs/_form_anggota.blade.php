<div class="form-group{!! $errors->has('kontak') ? 'has-error' : '' !!}">
		{!! Form::label('kontak', 'Pilih Kontak', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('kontak', [''=>'']+App\Kontak::pluck('nama','id')->all(), null, ['class'=>'form-control js-selectize', 'placeholder' => 'Pilih Kontak']) !!}
		{!! $errors->first('kontak', '<p class="help-block">:message</p>') !!}
	</div>

		{!! Form::hidden('grub', $value = $grub->id, ['class'=>'form-control']) !!}
		{!! Form::submit('Tambah Ke Grup', ['class'=>'btn btn-primary']) !!}
	 	<a class="btn btn-primary" href="{{ route('kontaks.index') }}">Tambah Kontak</a>
</div>
 