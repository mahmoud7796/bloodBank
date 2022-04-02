@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('dashboard.requests')}}</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{__('dashboard.dashboard')}}</a></li>
                <li class="active">{{__('dashboard.requests')}}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('dashboard.edit')}} {{__('dashboard.request') }}</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{route('dashboard.requests.update',$request)}}" method="POST" role="form">
                            @csrf
                            @include('partials._errors')
                            @method('PUT')
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="title">{{__('dashboard.title')}}</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="{{__('dashboard.title')}}" value="{{old('title') ?? $request->title}}" required autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">{{__('dashboard.description')}}</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="4" cols="50" placeholder="{{__('dashboard.description')}}" required>{{$request->description}}
                                    </textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="user_id">{{__('dashboard.user')}}</label>
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="">-------</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$request->user->id == $user->id ? 'selected':''}}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                @php
                                    $blood_types=array(
                                        "A+"=>'A+',
                                        "A-"=>'A-',
                                        "B+"=>'B+',
                                        "B-"=>'B-',
                                        "O+"=>'O+',
                                        "O-"=>'O-',
                                        "AB+"=>'AB+',
                                        "AB-"=>'AB-',
                                    );
                                @endphp
                                <div class="form-group">
                                    <label for="blood_type">{{__('dashboard.blood_type')}}</label>
                                    <select name="blood_type" id="blood_type" class="form-control @error('blood_type') is-invalid @enderror">
                                        <option value="">-------</option>
                                        @foreach($blood_types as $blood_type)
                                            <option value="{{$blood_type}}" {{ $user->blood_type==$blood_type ? 'selected':'' }}>{{$blood_type}}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_of_bags">{{__('dashboard.no_of_bags')}}</label>
                                    <input type="number" name="no_of_bags" min="1" max="20" class="form-control @error('no_of_bags') is-invalid @enderror" id="no_of_bags"
                                           value="{{ old('no_of_bags') ?? $request->no_of_bags }}" required >

                                    @error('no_of_bags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">{{__('dashboard.phone_number')}}</label>
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                                           placeholder="{{__('dashboard.phone_number')}}" value="{{ old('phone_number') ?? $request->phone_number }}" required >

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>





                                <div class="form-group">
                                    <label for="governorate_id">{{__('dashboard.governorate')}}</label>
                                    <select name="governorate_id" id="governorate_id" class="form-control">
                                        <option>----</option>
                                        @foreach($governorates as $governorate)
                                            <option value="{{$governorate->id}}" {{  $request->governorate_id == $governorate->id ? 'selected' : ''}}>{{$governorate->governorate_name}}</option>
                                        @endforeach

                                    </select>

                                    @error('governorate_id')
                                    <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <label for="city_id">{{__('dashboard.city')}}</label>
                                    <select name="city_id" id="city_id" class="form-control">
                                        <option value="{{$request->city_id}}" >{{$request->city->city_name_en}}</option>
                                    </select>

                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="request_expiredDate">{{__('dashboard.request_expiredDate')}}</label>
                                    <input type="date" name="request_expiredDate" min="" class="form-control @error('request_expiredDate') is-invalid @enderror" id="request_expiredDate"
                                           placeholder="{{__('dashboard.request_expiredDate')}}" value="{{ old('request_expiredDate') ?? $request->request_expiredDate }}" required >

                                    @error('request_expiredDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            var city_id = $('#city_id').val();
            // console.log(city_id);
            $('#governorate_id').on('change',function() {
                var governorate_id = $(this).val();
                $.ajax({
                    url:"{{ route('dashboard.get_cities') }}",
                    type:"get",
                    data: {
                        governorate_id: governorate_id
                    },
                    success:function (data) {
                        $('#city_id').empty();
                        $.each(data,function(key,city){
                            let selected = false;
                            if(city_id == city.id){
                                selected = true;
                            }

                            $('#city_id').append('<option value="'+city.id+'">'+city.city_name+'</option>');
                        })
                    }
                })
            });
        });

    </script>
@endpush

