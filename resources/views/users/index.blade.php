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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-md-8">
                                <h3 class="box-title">{{__('dashboard.users')}}</h3>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('dashboard.add')}}</a>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{__('dashboard.id')}}</th>
                                    <th>{{__('dashboard.name')}}</th>
                                    <th>{{__('dashboard.email')}}</th>
                                    <th>{{__('dashboard.profile_picture')}}</th>
                                    <th>{{__('dashboard.phone_number')}}</th>
                                    <th>{{__('dashboard.date_of_birth')}}</th>
                                    <th>{{__('dashboard.blood_type')}}</th>
                                    <th>{{__('dashboard.last_donate_time')}}</th>
                                    <th>{{__('dashboard.governorate')}}</th>
                                    <th>{{__('dashboard.available_for_donate')}}</th>
                                    <th>{{__('dashboard.created_at')}}</th>
                                    <th>{{__('dashboard.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <img src="{{ $user->profile_picture ? asset(viewImage($user->profile_picture,'dashboard_files/users_pictures/')) : asset('dashboard_files/admins_pictures/blank.png') }}" style="width: 100px;" class="img-thumbnail" alt="">
                                    </td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->date_of_birth}}</td>
                                    <td>{{$user->blood_type}}</td>
                                    <td>{{$user->last_donate_time}}</td>
                                    <td>{{$user->governorate->governorate_name}}</td>
                                    <td>{{$user->available_for_donate}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <a href="{{ route('dashboard.users.show', $user) }}" class="btn btn-warning btn-sm"><i class="fa fa-microchip"></i> {{__('dashboard.show')}}</a>
                                        <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{__('dashboard.edit')}}</a>
                                        <form action="{{ route('dashboard.users.destroy', $user) }}" method="post" style="display: inline-block">
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
                                    <th>{{__('dashboard.name')}}</th>
                                    <th>{{__('dashboard.email')}}</th>
                                    <th>{{__('dashboard.profile_picture')}}</th>
                                    <th>{{__('dashboard.phone_number')}}</th>
                                    <th>{{__('dashboard.date_of_birth')}}</th>
                                    <th>{{__('dashboard.blood_type')}}</th>
                                    <th>{{__('dashboard.last_donate_time')}}</th>
                                    <th>{{__('dashboard.governorate')}}</th>
                                    <th>{{__('dashboard.available_for_donate')}}</th>
                                    <th>{{__('dashboard.created_at')}}</th>
                                    <th>{{__('dashboard.action')}}</th>
                                </tr>
                                </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
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
