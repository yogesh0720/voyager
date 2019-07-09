@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($inquiryData->id) ? 'edit' : 'add')) . ' ' .$inquiryData->title)

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
<h1 class="page-title"><i class="voyager-activity"></i>{{__('voyager::generic.'.(isset($inquiryData->id) ? 'edit' : 'add')) . ' ' .$inquiryData->title}}</h1>
@stop

@section('content')
<div class="page-content container-fluid">
    <form class="form-edit-add" role="form" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-bordered">
                    {{--
                    <div class="panel"> --}}
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
                                       placeholder="FirstName" value="{{ $inquiryData->firstName ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="lastName">LastName</label>
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                       placeholder="LastName"
                                       value="{{ $inquiryData->lastName ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address"
                                          placeholder="Address"
                                >{{ $inquiryData->address ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="contactNo">ContactNo</label>
                                <input type="tel" class="form-control" id="contactNo" name="contactNo"
                                       placeholder="ContactNo"
                                       value="{{ $inquiryData->contactNo ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="emailID">emailID</label>
                                <input type="email" class="form-control" id="emailID" name="emailID"
                                       placeholder="emailID"
                                       value="{{ $inquiryData->emailID ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="occupation">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation"
                                       placeholder="Occupation"
                                       value="{{ $inquiryData->occupation ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="inquiryFor">InquiryFor</label>
                                <input type="text" class="form-control" id="inquiryFor" name="inquiryFor"
                                       placeholder="InquiryFor"
                                       value="{{ $inquiryData->inquiryFor ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="create_model">Status</label><br>
                                <input type="checkbox" id="status" name="status" data-toggle="toggle"
                                       data-on="Active" data-off="In-Active" checked="checked">
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="btnSave" id="btnSave">Save</button> &nbsp;
            <a href="{{ route('index') }}" class="btn btn-danger" name="btnCancel" id="btnCancel">Cancel</a>
    </form>
</div>
@stop
