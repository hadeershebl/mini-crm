@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-body">
            {{-- back btn  --}}
            <a href="{{ route('employee.index') }}" class="btn btn-warning float-right">
                {{__('translations.back')}}
                <li class="fa fa-arrow-left"></li>
            </a>

            <br><br>
            <div class="row card card-light col-md-11">
                <div class="card-header">
                    {{__('translations.employee_details') .' ( '. $employee->name() . ' ) '}}
                </div>
                <!-- /.card-header -->
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>{{__('translations.id')}}</th>
                                <td>{{$employee->id}}</td>
                            </tr>
                             <tr>
                                <th>{{__('translations.first_name')}}</th>
                                <td>{{$employee->first_name}}</td>
                            </tr>
                            <tr>
                                <th>{{__('translations.last_name')}}</th>
                                <td>{{$employee->last_name}}</td>
                            </tr>

                             <tr>
                                <th>{{__('translations.company')}}</th>
                                <td>{{$employee->company->name}}</td>
                            </tr>

                            <tr>
                                <th>{{__('translations.email')}}</th>
                                <td>{{$employee->email != null ? $employee->email : '--'}}</td>
                            </tr>
                            <tr>
                                <th>{{__('translations.phone')}}</th>
                                <td>{{$employee->phone != null ? $employee->phone : '--'}}</td>
                            </tr>

                            <tr>
                                <th>{{__('translations.created_at')}}</th>
                                <td>{{$employee->created_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>


        </div>
    </div>
    @endsection
