@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('dashboard.users')}}</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{__('dashboard.dashboard')}}</a></li>
                <li class="active">{{__('dashboard.users')}}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('dashboard.create')}} {{__('dashboard.user') }} </h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{route('dashboard.users.store')}}" method="POST" role="form" enctype="multipart/form-data">
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
                                    <label for="date_of_birth">{{__('dashboard.date_of_birth')}}</label>
                                    <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth"
                                           placeholder="{{__('dashboard.date_of_birth')}}" value="{{ old('date_of_birth') }}" required >

                                    @error('date_of_birth')
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
                                            <option value="{{$blood_type}}" {{old('blood_type')== $blood_type ? 'selected':''}}>{{$blood_type}}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_type')
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
                                                <option value="{{$governorate->id}}" {{old('governorate_id')== $governorate->id ? 'selected':''}}>{{$governorate->governorate_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('governorate_id')
                                        <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        <label for="city_id">{{__('dashboard.city')}}</label>
                                        <select name="city_id" id="city_id" class="form-control">
                                        </select>

                                        @error('city_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="last_donate_time">{{__('dashboard.last_donate_time')}}</label>
                                    <input type="date" name="last_donate_time" class="form-control @error('last_donate_time') is-invalid @enderror" id="last_donate_time"
                                           placeholder="{{__('dashboard.last_donate_time')}}" value="{{ old('last_donate_time') }}" required >

                                    @error('last_donate_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <input type="checkbox" name="available_for_donate" id="available_for_donate"
                                            value="{{ old('available_for_donate') ?? 1 }}">   <label for="available_for_donate">{{__('dashboard.available_for_donate')}}</label>

                                    @error('available_for_donate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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

@push('child-scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
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
                            var selectedVal = city.id == '{{old('city_id')}}' ? "selected" : "";
                            $('#city_id').append('<option value="'+city.id+'" '+selectedVal +'>'+city.city_name+'</option>');
                        })
                    }
                })
            });
        });

    </script>
{{--    <script>--}}
{{--        $(function (){--}}
{{--            $(document).on('change','#governorate_id',function (){--}}
{{--                populateCities();--}}

{{--                return false;--}}
{{--            });--}}

{{--            function populateCities() {--}}
{{--                $('option', $('#city_id')).remove();--}}
{{--                $('#city_id').append($('<option></option>').val('').html(' --- '));--}}
{{--                var governorate_id = $('#governorate_id').val() != null ? $('#governorate_id').val() : '{{ old('governorate_id') }}';--}}
{{--                $.get("{{ route('dashboard.get_cities') }}", { governorate_id: governorate_id }, function (data) {--}}
{{--                    $.each(data, function(val,text) {--}}
{{--                        var selectedVal = val == '{{ old('city_id') }}' ? "selected" : "";--}}
{{--                        $('#city_id').append($('<option ' + selectedVal + '></option>').val(val).html(text));--}}
{{--                    })--}}
{{--                }, "json");--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endpush

