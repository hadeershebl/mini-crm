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
            <a href="{{ route('home') }}" class="btn btn-warning float-right">
                {{__('translations.back')}}
                <li class="fa fa-arrow-left"></li>
            </a>

            <div class="row">

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">

                            {{-- create btn --}}
                            <a href="{{ route('company.create') }}" class="btn btn-success">
                                {{__('translations.create')}}
                                <li class="fa fa-plus-circle"></li>
                            </a>

                            <form method="GET" action="{{ route('company.index') }}" accept-charset="UTF-8"
                                class="form-inline my-2 my-lg-0 float-right" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="{{ __('translations.search') .'...' }}"
                                        value="{{ request('search') }}">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            {{ __('translations.search') }}
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>

                            <br />
                            <br />
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('translations.id') }}</th>
                                            <th>{{ __('translations.name') }}</th>
                                            <th>{{ __('translations.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($companies) == 0)
                                        <tr>
                                            <td colspan="10" class="text-center"
                                                style="font-weight: bold; font-size: 16px">
                                                {{__('translations.no_date_to_show')}}</td>
                                        </tr>
                                        @endif

                                        @foreach($companies as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>

                                                {{-- show btn --}}
                                                <a href="{{ route('company.show' , $item->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{__('translations.details')}}
                                                    <li class="fa fa-info"></li>
                                                </a>

                                                {{-- edit btn --}}
                                                <a href="{{ route('company.edit' , $item->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    {{__('translations.edit')}}
                                                    <li class="fa fa-edit"></li>
                                                </a>

                                                {{-- delete btn --}}
                                                <a href="{{ route('company.delete' , $item->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                     onclick="return confirm(&quot;{{__('translations.confirm_delete')}}&quot;)">
                                                    {{__('translations.delete')}}
                                                    
                                                    <li class="fa fa-trash"></li>
                                                </a>


                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $companies->appends(['search' =>
                                    Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @endsection
