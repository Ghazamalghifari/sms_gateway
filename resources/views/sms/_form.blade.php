<div class="form-group{{ $errors->has('isi_pesan') ? ' has-error' : '' }}">
	{!! Form::label('isi_pesan', 'Isi Pesan : ', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-6">
		{!! Form::textArea('isi_pesan', null, ['class'=>'form-control', 'onKeyUp'=>'HitungText()']) !!}
		{!! $errors->first('isi_pesan', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jumlah_pesan') ? ' has-error' : '' }}">
	{!! Form::label('jumlah_pesan', ' ', ['class'=>'col-md-4 control-label']) !!}
	<div class="col-sm-2">
<p>Jumlah Sms : <input id="jumlah_pesan" size="3" readonly="" value="1" name="jumlah_sms"></p>
</div>

	<div class="col-sm-2">
<p id="hasil" align="center">Jumlah Karakter :</p>
	</div>
</div>

<div class="form-group{!! $errors->has('id_kontak') ? 'has-error' : '' !!}">
	{!! Form::label('id_kontak', 'Nomor Tujuan', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-6">
		{!! Form::select('id_kontak', $kontak, null, ['class'=>'form-control js-selectize', 'placeholder' => 'Pilih Kontak'
		]) !!}
		{!! $errors->first('id_kontak', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
<div class="col-md-4 col-md-offset-7">
{!! Form::submit('Kirim', ['class'=>'btn btn-primary']) !!}
</div>
</div>