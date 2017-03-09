@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-12">
<ul class="breadcrumb">
<li><a href="{{ url('/home') }} ">Dashboard</a></li>
<li><a href="{{ url('/sms/grubs/') }}">Grup</a></li>
<li class="active">Anggota Grup </li>
</ul>

@include('kontaks.menu')

<div class="panel panel-default">
<div class="panel-heading">
<h2 class="panel-title">Tambah Anggota</h2>
</div>
<div class="panel-body">
{!! Form::open(['url' => route('anggotas.store'),
'method' => 'post', 'class'=>'form-horizontal']) !!}
@include('grubs._form_anggota')
{!! Form::close() !!}
</div>
</div>

<!-- tabel anggota grub -->
<div class="panel panel-default">
<div class="panel-heading">
<h2 class="panel-title">Anggota </h2>
</div>
<div class="panel-body">
 
{!! $html->table(['class'=>'table-striped table']) !!}
</div>
</div>
<!--/ panel komen --> 
 

</div>
</div>
</div>

@endsection

@section('scripts')
{!! $html->scripts() !!}
@endsection
