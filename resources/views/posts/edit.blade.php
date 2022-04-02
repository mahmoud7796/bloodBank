@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('dashboard.posts')}}</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{__('dashboard.dashboard')}}</a></li>
                <li class="active">{{__('dashboard.posts')}}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('dashboard.edit')}} {{__('dashboard.post') }}</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{route('dashboard.posts.update',$post)}}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            @include('partials._errors')
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">{{__('dashboard.title')}}</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="{{__('dashboard.title')}}" value="{{ old('title') ?? $post->title }}" required autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">{{__('dashboard.description')}}</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="4" cols="50" placeholder="{{__('dashboard.description')}}" required>{{$post->description}}
                                    </textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <img class="img-thumbnail" height="500" width="500" src="{{ $post->image ? asset(viewImage($post->image,'dashboard_files/posts/')) : asset('dashboard_files/admins_pictures/blank.png') }}"><br>
                                    <label for="image">{{__('dashboard.image')}}</label>
                                    <input type="file" name="image" class="form-control" id="image">

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


@push('child-scripts')

@endpush

