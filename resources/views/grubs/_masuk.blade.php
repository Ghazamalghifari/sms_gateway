{!! Form::model($model, ['url' => $form_url, 'method' => 'post', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::hidden('kontak', $model->id, ['class'=>'form-control']) !!}
{!! Form::hidden('grub', $id_grup, ['class'=>'form-control']) !!}
{!! Form::submit('Masuk', ['class'=>'btn btn-sm btn-primary']) !!}
{!! Form::close() !!}