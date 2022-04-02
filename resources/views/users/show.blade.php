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
                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('dashboard.show')}} {{__('dashboard.user') }}</h3>
                        </div><!-- /.box-header -->

                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ $user->profile_picture ? asset(viewImage($user->profile_picture,'dashboard_files/users_pictures/')) : asset('dashboard_files/admins_pictures/blank.png') }}"
                                 alt="User profile picture">
                            <h3 class="profile-username text-center">{{$user->name}}</h3>
                            <p class="text-muted text-center">{{$user->email}}</p>
                            <p class="text-muted text-center">{{$user->phone_number}}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>{{__('dashboard.blood_type')}}</b> <a class="pull-right">{{$user->blood_type}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{__('dashboard.date_of_birth')}}</b> <a class="pull-right">{{$user->date_of_birth}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{__('dashboard.last_donate_time')}}</b> <a class="pull-right">{{$user->last_donate_time}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{__('dashboard.governorate')}}</b> <a class="pull-right">{{\LaravelLocalization::getCurrentLocale()== 'en' ? $user->governorate->governorate_name_en : $user->governorate->governorate_name_ar}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{__('dashboard.city')}}</b> <a class="pull-right">{{\LaravelLocalization::getCurrentLocale()== 'en' ? $user->city->city_name_en : $user->city->city_name_ar}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{__('dashboard.available_for_donate')}}</b> <a class="pull-right">{{$user->available_for_donate}}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{__('dashboard.created_at')}}</b> <a class="pull-right">{{$user->created_at}}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{__('dashboard.updated_at')}}</b> <a class="pull-right">{{$user->updated_at}}</a>
                                </li>
                            </ul>
                            <div class="d-flex">
                                <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-primary"><b><i class="fa fa-edit"></i> {{__('dashboard.edit')}}</b></a>
                                <form action="{{ route('dashboard.users.destroy', $user) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{__('dashboard.delete')}}</button>
                                </form><!-- end of form -->
                            </div>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div><!--/.col (left) -->
                <div class="col-md-9">
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{__('dashboard.id')}}</th>
                                <th>{{__('dashboard.title')}}</th>
                                <th>{{__('dashboard.user')}}</th>
                                <th>{{__('dashboard.phone_number')}}</th>
                                <th>{{__('dashboard.governorate')}}</th>
                                <th>{{__('dashboard.city')}}</th>
                                <th>{{__('dashboard.blood_type')}}</th>
                                <th>{{__('dashboard.no_of_bags')}}</th>
                                <th>{{__('dashboard.request_expiredDate')}}</th>
                                <th>{{__('dashboard.created_at')}}</th>
                                <th>{{__('dashboard.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user->requests as $request)
                                <tr>
                                    <td>{{$request->id}}</td>
                                    <td>{{$request->title}}</td>
                                    <td>{{$request->user->name}}</td>
                                    <td>{{$request->phone_number}}</td>
                                    <td>{{\LaravelLocalization::getCurrentLocale()== 'en' ? $request->governorate->governorate_name_en : $request->governorate->governorate_name_ar}}</td>
                                    <td>{{$request->city->city_name}}</td>
                                    <td>{{$request->blood_type}}</td>
                                    <td>{{$request->no_of_bags}}</td>
                                    <td>{{$request->request_expiredDate}}</td>
                                    <td>{{$request->created_at}}</td>
                                    <td>
                                        <a href="{{ route('dashboard.requests.edit', $request) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{__('dashboard.edit')}}</a>
                                        <form action="{{ route('dashboard.requests.destroy', $request) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> {{__('dashboard.delete')}}</button>
                                        </form><!-- end of form -->
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{__('dashboard.id')}}</th>
                                <th>{{__('dashboard.title')}}</th>
                                <th>{{__('dashboard.user')}}</th>
                                <th>{{__('dashboard.phone_number')}}</th>
                                <th>{{__('dashboard.governorate')}}</th>
                                <th>{{__('dashboard.city')}}</th>
                                <th>{{__('dashboard.blood_type')}}</th>
                                <th>{{__('dashboard.no_of_bags')}}</th>
                                <th>{{__('dashboard.request_expiredDate')}}</th>
                                <th>{{__('dashboard.created_at')}}</th>
                                <th>{{__('dashboard.action')}}</th>
                            </tr>
                            </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>
            </div>   <!-- /.row -->
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


@push('child-scripts')
    <script src="{{ asset('dashboard_files/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard_files/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endpush

