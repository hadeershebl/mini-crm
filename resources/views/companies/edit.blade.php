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
            <a href="{{ route('company.index') }}" class="btn btn-warning float-right">
                {{__('translations.back')}}
                <li class="fa fa-arrow-left"></li>
            </a>

            <br><br>
            <div class="row card card-light col-md-11">
                <div class="card-header">
                    {{__('translations.edit_company') .' ( '. $company->name . ' ) '}}
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form method="POST" action="{{route('company.update')}}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$company->id}}">
                    <div class="card-body">
                        {{-- name --}}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">* {{__('translations.name') }}
                            </label>
                            <input type="text" name="name" class="form-control"
                                placeholder="{{__('translations.enter_name')}}" value="{{ $company->name }}">

                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>

                        {{-- email --}}
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">{{__('translations.email')}}</label>
                            <input type="email" name="email" class="form-control" value="{{ $company->email }}"
                                placeholder="{{__('translations.enter_email')}}">

                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>

                        {{-- website --}}
                        <div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">{{__('translations.website') }}
                            </label>
                            <input type="text" name="website" class="form-control"
                                placeholder="{{__('translations.enter_website')}}" value="{{ $company->website }}">

                            {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
                        </div>

                        {{-- logo --}}
                        <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
                            <label for="password">{{ __('translations.logo') }}
                                <span class="text-info ml-2"
                                    style="font-size: 12px">{{__('translations.minimum_100*100')}}</span>
                            </label>
                            <input class="form-control" name="logo" type="file">
                            @if (isset($company->logo))
                            <a href="{{asset('storage/' . $company->logo)}}" target="_blank">
                            <img src="{{asset('storage/' . $company->logo)}}" alt=""
                                style="width:250px ; height:110px;"> 
                            </a>
                            @endif

                            {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
                        </div>

                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i> {{__('translations.edit')}}</button>

                    </div>

                </form>

            </div>


        </div>
    </div>
    @endsection
