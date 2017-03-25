
<div class="form-group">
	<div class="col-sm-6">
		<input type="text" readonly="" value="Tambahkan kata [nama] pada isi pesan untuk menampilkan nama si penerima SMS." class="form-control">
	</div>
	<div class="col-sm-6">
		<input type="text" readonly="" value="Contoh : Kepada sdr. [nama] selamat anda mendapatkan hadiah sepedah motor" class="form-control">
	</div>
</div>


<div class="form-group{{ $errors->has('isi_pesan') ? ' has-error' : '' }}">
		{!! Form::label('isi_pesan', 'Isi Pesan : ', ['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-6">
		{!! Form::textArea('isi_pesan', null, ['class'=>'form-control', 'onKeyUp'=>'HitungText()']) !!}
		{!! $errors->first('isi_pesan', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jumlah_pesan') ? ' has-error' : '' }}">
	{!! Form::label('jumlah_pesan', ' ', ['class'=>'col-md-5 control-label']) !!}
	<div class="col-sm-2">
		<p>Jumlah Sms : <input id="jumlah_pesan" size="3" readonly="" value="1" name="jumlah_sms"></p>
	</div>
	<div class="col-sm-2">
		<p id="hasil" align="center">Jumlah Karakter :</p>
	</div>
</div>

<div class="form-group{!! $errors->has('id_kontak') ? 'has-error' : '' !!}">
		{!! Form::label('id_kontak', 'Nomor Tujuan', ['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-6">
		{!! Form::select('id_kontak', $kontak, null, ['class'=>'form-control js-selectize', 'placeholder' => 'Pilih Kontak'
		]) !!}
		{!! $errors->first('id_kontak', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-8"> 
		<button id="kirim_sms" class="btn btn-primary">Kirim</button>
	</div>
</div>