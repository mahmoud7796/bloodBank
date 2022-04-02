@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('dashboard.admins')}}</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{__('dashboard.dashboard')}}</a></li>
                <li class="active">{{__('dashboard.admins')}}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('dashboard.create')}} {{__('dashboard.admin') }} </h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{route('dashboard.admins.store')}}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            @include('partials._errors')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">{{__('dashboard.name')}}</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                           placeholder="{{__('dashboard.name')}}" value="{{ old('name') }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">{{__('dashboard.email')}}</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                           placeholder="{{__('dashboard.email')}}" value="{{ old('email') }}" required >

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">{{__('dashboard.phone_number')}}</label>
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                                           placeholder="{{__('dashboard.phone_number')}}" value="{{ old('phone_number') }}" required >

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="password">{{__('dashboard.password')}}</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                           placeholder="{{__('dashboard.password')}}" required >

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">{{__('dashboard.password_confirmation')}}</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                           placeholder="{{__('dashboard.password_confirmation')}}" required >

                                </div>


                                <div class="form-group">
                                    <label for="profile_picture">{{__('dashboard.profile_picture')}}</label>
                                    <input type="file" name="profile_picture" class="form-control" id="profile_picture"
                                           placeholder="{{__('dashboard.profile_picture')}}"  >

                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{__('dashboard.save')}}</button>
                            </div>
                        </form>
                    </div><!-- /.box -->


                </div><!--/.col (left) -->
            </div>   <!-- /.row -->
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


