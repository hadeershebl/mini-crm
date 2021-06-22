@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-body">
            {{-- back btn  --}}
            <a href="{{ route('company.index') }}" class="btn btn-warning float-right">
                {{__('translations.back')}}
                <li class="fa fa-arrow-left"></li>
            </a>

            <br><br>
            <div class="row card card-light col-md-11">
                <div class="card-header">
                    {{__('translations.company_details') .' ( '. $company->name . ' ) '}}
                </div>
                <!-- /.card-header -->
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>{{__('translations.id')}}</th>
                                <td>{{$company->id}}</td>
                            </tr>
                             <tr>
                                <th>{{__('translations.name')}}</th>
                                <td>{{$company->name}}</td>
                            </tr>
                            <tr>
                                <th>{{__('translations.email')}}</th>
                                <td>{{$company->email != null ? $company->email : '--'}}</td>
                            </tr>
                            <tr>
                                <th>{{__('translations.website')}}</th>
                                <td>{{$company->website != null ? $company->website : '--'}}</td>
                            </tr>
                            <tr>
                                <th>{{__('translations.logo')}}</th>
                                <td>
                                    @if ($company->logo == null)
                                    {{ __('translations.didnot_add_file')}}
                                    @else
                                    <a href="{{asset('storage/' . $company->logo)}}"
                                        target="_blank">{{__('translations.see_logo')}}</a>
                                    @endif
                                </td>
                            </tr>

                              <tr>
                                <th>{{__('translations.created_at')}}</th>
                                <td>{{$company->created_at}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>


        </div>
    </div>
    @endsection
