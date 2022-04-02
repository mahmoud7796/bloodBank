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
                            <h3 class="box-title">{{__('dashboard.edit')}} {{__('dashboard.admin') }}</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{route('dashboard.admins.update',$admin)}}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            @include('partials._errors')
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$admin->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">{{__('dashboard.name')}}</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                           placeholder="{{__('dashboard.name')}}" value="{{ old('name') ?? $admin->name }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">{{__('dashboard.email')}}</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                           placeholder="{{__('dashboard.email')}}" value="{{ old('email') ?? $admin->email }}" required >

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">{{__('dashboard.phone_number')}}</label>
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                                           placeholder="{{__('dashboard.phone_number')}}" value="{{ old('phone_number') ?? $admin->phone_number }}" required >

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="password">{{__('dashboard.password')}}</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                           placeholder="{{__('dashboard.password')}}"  >

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">{{__('dashboard.password_confirmation')}}</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                           placeholder="{{__('dashboard.password_confirmation')}}"  >

                                </div>

                                <div class="form-group">
                                    <img class="img-thumbnail" height="300" width="300" src="{{ $admin->profile_picture ? asset(viewImage($admin->profile_picture,'dashboard_files/admins_pictures/')) : asset('dashboard_files/admins_pictures/blank.png') }}"><br>
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


