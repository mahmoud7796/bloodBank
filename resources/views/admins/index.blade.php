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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-md-8">
                                <h3 class="box-title">{{__('dashboard.admins')}}</h3>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('dashboard.admins.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('dashboard.add')}}</a>
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
                                    <th>{{__('dashboard.created_at')}}</th>
                                    <th>{{__('dashboard.updated_at')}}</th>
                                    <th>{{__('dashboard.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($admins as $admin)
                                <tr>
                                    <td>{{$admin->id}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        <img src="{{ $admin->profile_picture ? asset(viewImage($admin->profile_picture,'dashboard_files/admins_pictures/')) : asset('dashboard_files/admins_pictures/blank.png') }}" style="width: 100px;" class="img-thumbnail" alt="">
                                    </td>
                                    <td>{{$admin->phone_number}}</td>
                                    <td>{{$admin->created_at}}</td>
                                    <td>{{$admin->updated_at}}</td>
                                    <td>
                                        <a href="{{ route('dashboard.admins.edit', $admin) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{__('dashboard.edit')}}</a>
                                        <form action="{{ route('dashboard.admins.destroy', $admin) }}" method="post" style="display: inline-block">
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
                                    <th>{{__('dashboard.created_at')}}</th>
                                    <th>{{__('dashboard.updated_at')}}</th>
                                    <th>{{__('dashboard.action')}}</th>
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
