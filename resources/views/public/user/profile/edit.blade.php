@extends('front.layouts.master')

@section('content')
	<div class="row">

		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('labels.update_information_box_title') }}</div>

				<div class="panel-body">

                       {!! Form::model($user, ['route' => 'front.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

                              <div class="form-group">
                                    {!! Form::label('name', trans('validation.attributes.name'), ['class' => ' control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'name', null, ['class' => 'form-control']) !!}
                                    </div>
                              </div>

                              @if ($user->canChangeEmail())
                                  <div class="form-group">
                                      {!! Form::label('email', trans('validation.attributes.email'), ['class' => ' control-label']) !!}
                                      <div class="col-md-6">
                                          {!! Form::input('email', 'email', null, ['class' => 'form-control']) !!}
                                      </div>
                                  </div>
                              @endif

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      {!! Form::submit(trans('labels.save_button'), ['class' => 'btn btn-primary']) !!}
                                  </div>
                              </div>

                       {!! Form::close() !!}

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection