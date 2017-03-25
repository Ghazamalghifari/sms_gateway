@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }} ">Home</a></li>
				<li><a href="{{ url('/sms/grubs/') }}">Grup</a></li>
				<li class="active">Anggota Grup </li>
			</ul>

			@include('kontaks.menu')

			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Tambah Anggota</h2>
					</div>

					<div class="panel-body">
						<!-- tabel kontak -->
						 <table  class="table-striped table" id="datatable_kontak">
							 <thead>
							 	<tr>
							 		<th >Id</th>
							 		<th >Nama</th>
							 		<th >Nomor Hp</th>
							 	</tr>
							 </thead>
						</table>
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<!-- tabel anggota grub -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Anggota </h2>
					</div>
					
					<div class="panel-body">
						{!! $html->table(['class'=>'table-striped table']) !!}
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

@endsection

@section('scripts')
{!! $html->scripts() !!}
<script type="text/javascript">
$("#datatable_kontak").DataTable({
	"serverSide":true,"processing":true,"ajax":"{{ url('sms/grub/kontak/'.$grub->id) }}","columns":[
	{"data":"nama","name":"nama","title":"Nama","orderable":true,"searchable":true},
	{"data":"nomor_hp","name":"nomor_hp","title":"Nomor Hp","orderable":true,"searchable":true},
	{"data":"action","name":"action","title":"","orderable":false,"searchable":false}
]});
</script>
@endsection
