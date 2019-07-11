@extends('voyager::master')

@section('page_title', 'View'. ' ' .$inquiryData->title)

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
<h1 class="page-title"><i class="voyager-activity"></i>{{ 'View'. ' ' .$inquiryData->title}}
    &nbsp;<!--<form action="{{ route('delete', $inquiryData->id) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>-->
    <a href="{{ route('edit', $inquiryData->id) }}" class="btn btn-info">
        <span class="glyphicon glyphicon-pencil"></span> Edit
    </a>
    <a href="javascript:;" title="Delete" class="btn btn-danger delete" data-id="2" id="delete-2">
        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
    </a>
    <a href="{{ route('index') }}" class="btn btn-warning">
        <span class="glyphicon glyphicon-list"></span>&nbsp;
        Return to List
    </a>
</h1>
@stop

@section('content')
<div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-bordered">
                    {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="firstName">FirstName</label>
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                       placeholder="FirstName" value="{{ $inquiryData->firstName ?? '' }}" disabled="disabled">
                            </div>

                            <div class="form-group">
                                <label for="lastName">LastName</label>
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                       placeholder="LastName"
                                       value="{{ $inquiryData->lastName ?? '' }}" disabled="disabled">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address"
                                          placeholder="Address" disabled="disabled"
                                >{{ $inquiryData->address ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="contactNo">ContactNo</label>
                                <input type="tel" class="form-control" id="contactNo" name="contactNo"
                                       placeholder="ContactNo"
                                       value="{{ $inquiryData->contactNo ?? '' }}" disabled="disabled">
                            </div>

                            <div class="form-group">
                                <label for="emailID">emailID</label>
                                <input type="text" class="form-control" id="emailID" name="emailID"
                                       placeholder="emailID"
                                       value="{{ $inquiryData->emailID ?? '' }}" disabled="disabled">
                            </div>

                            <div class="form-group">
                                <label for="occupation">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation"
                                       placeholder="Occupation"
                                       value="{{ $inquiryData->occupation ?? '' }}" disabled="disabled">
                            </div>

                            <div class="form-group">
                                <label for="inquiryFor">InquiryFor</label>
                                <input type="text" class="form-control" id="inquiryFor" name="inquiryFor"
                                       placeholder="InquiryFor"
                                       value="{{ $inquiryData->inquiryFor ?? '' }}" disabled="disabled">
                            </div>

                            <div class="form-group">
                                <label for="create_model">Status</label><br>
                                <input type="checkbox" id="status" name="status" data-toggle="toggle"
                                       data-on="Active" data-off="In-Active" checked="checked" disabled="disabled">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</div>
@stop
