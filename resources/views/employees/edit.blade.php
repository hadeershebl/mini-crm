@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-body">
            @if (session('message'))
            <div class="alert alert-success col-12">
                {{ session('message') }}
            </div>
            @endif
            {{-- back btn  --}}
            <a href="{{ route('employee.index') }}" class="btn btn-warning float-right">
                {{__('translations.back')}}
                <li class="fa fa-arrow-left"></li>
            </a>

            <br><br>
            <div class="row card card-light col-md-11">
                <div class="card-header">
                    {{__('translations.edit_employee') .' ( '. $employee->name() . ' ) '}}
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form method="POST" action="{{route('employee.update')}}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$employee->id}}">
                    <div class="card-body">
                        {{-- first name --}}
                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">* {{__('translations.first_name') }}
                            </label>
                            <input type="text" name="first_name" class="form-control"
                                placeholder="{{__('translations.enter_first_name')}}" value="{{ $employee->first_name}}">

                            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                        </div>

                        {{-- last name --}}
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">* {{__('translations.last_name') }}
                            </label>
                            <input type="text" name="last_name" class="form-control"
                                placeholder="{{__('translations.enter_last_name')}}" value="{{ $employee->last_name}}">

                            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                        </div>


                        {{-- companies --}}
                        <div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
                            <label for="company_id"
                                class="control-label">* {{ __('translations.company') }}</label>
                            <select name="company_id" class="form-control" >
                                <option value="" selected disabled>{{ __('translations.select_company_name') }}</option>
                                @foreach($companies as $item)
                                
                                <option value="{{$item->id}}"
                                    {{$item->id == $employee->company_id ? 'selected' : ''}}>{{$item->name}}
                                </option>
                               
                                @endforeach

                            </select>
                            {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                        </div>
                        

                        {{-- email --}}
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">{{__('translations.email')}}</label>
                            <input type="email" name="email" class="form-control" value="{{ $employee->email}}"
                                placeholder="{{__('translations.enter_email')}}">

                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>

                        {{-- phone --}}
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">{{__('translations.phone') }}
                            </label>
                            <input type="number" name="phone" class="form-control"
                                placeholder="{{__('translations.enter_phone')}}" value="{{  $employee->phone }}">

                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                        </div>

                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i> {{__('translations.edit')}}</button>

                    </div>

                </form>

            </div>


        </div>
    </div>
    @endsection
