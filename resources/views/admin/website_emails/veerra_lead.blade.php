@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    {!! breadcrumb('Lead Email 1 Hour ') !!}

    <form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
        @csrf

        <div class="card">


            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="email_subject">Email Subject</label>
                                    <input class="form-control" id="email_subject" type="text" name="email_subject"
                                        placeholder="" value="{{ $sitecontent['email_subject'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="email_greeting">Greeting Text</label>
                                    <input class="form-control" id="email_greeting" type="text" name="email_greeting"
                                        placeholder="" value="{{ $sitecontent['email_greeting'] ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="email_body">Top Text</label>
                                    <textarea id="email_body" name="email_body" rows="4" class="editor">{{ $sitecontent['email_body'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="email_body2">Below Text</label>
                                    <textarea id="email_body2" name="email_body2" rows="4" class="editor">{{ $sitecontent['email_body2'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                <button class="btn btn-primary" type="submit">Update Email</button>
            </div>
        </div>

    @endsection
