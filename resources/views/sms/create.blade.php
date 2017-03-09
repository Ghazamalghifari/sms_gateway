@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-12">
<ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Dashboard</a></li>
<li class="active">KIRIM PESAN</li>
</ul>
@include('sms.menu')
<div class="panel panel-default">
<div class="panel-heading">
<h2 class="panel-title">KIRIM SMS KE SATU</h2>
</div>
<div class="panel-body"> 
 {!! Form::open(['url' => route('sms.store'),'method' => 'post','name'=>'pesan', 'class'=>'form-horizontal']) !!}
@include('sms._form')
{!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("keyup","#isi_pesan",function(){
			var Teks = document.pesan.isi_pesan.value.length;
			    if (Teks < 161) {
				$("#jumlah_pesan").val("1")
			    }
			    else if (Teks > 160){
				var hitung_sms = Teks % 160;
				if (hitung_sms == 0) {

				var hitung_sms = Teks/160;
				var hasil = Math.floor(hitung_sms);
				$("#jumlah_pesan").val(hasil)
				}
				else {

				var hitung_sms = Teks/160;
				var hasil = Math.floor(hitung_sms) + 1;
				$("#jumlah_pesan").val(hasil)

				}

			}
		});
	});
</script>

<script language='javascript'>
function HitungText(){
var Teks = document.pesan.isi_pesan.value.length;
var total = document.getElementById('hasil');
total.innerHTML = 'Jumlah Karakter : ' + Teks ;
}
</script>
@endsection 