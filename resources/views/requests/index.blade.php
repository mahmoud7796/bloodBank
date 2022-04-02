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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-md-8">
                                <h3 class="box-title">{{__('dashboard.requests')}}</h3>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('dashboard.requests.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('dashboard.add')}}</a>
                            </div>
                        </div><!-- /.box-header -->
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
                                @forelse($requests as $request)
                                <tr>
                                    <td>{{$request->id}}</td>
                                    <td>{{$request->title}}</td>
                                    <td><a href="{{route('dashboard.users.show',$request->user)}}">{{$request->user->name}}</a></td>
                                    <td>{{$request->phone_number}}</td>
                                    <td>{{$request->governorate->governorate_name}}</td>
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
