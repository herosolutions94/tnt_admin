@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!!breadcrumb('Website Emails')!!}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap align-middle dataTable basic-datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Page Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td width="65%">Lead Email 1 Hour</td>
                            <td>
                                <a href="{{ url('admin/emails/email_1hour') }}" class="btn btn-primary active">Edit Email</a>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td width="65%">Lead Email 24 Hours</td>
                            <td>
                                <a href="{{ url('admin/emails/email_24hours') }}" class="btn btn-primary active">Edit Email</a>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td width="65%">Lead Email 72 Hours</td>
                            <td>
                                <a href="{{ url('admin/emails/email_72hours') }}" class="btn btn-primary active">Edit Email</a>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td width="65%">Lead Email 1 Week</td>
                            <td>
                                <a href="{{ url('admin/emails/email_1week') }}" class="btn btn-primary active">Edit Email</a>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td width="65%">Veerra-fied Lead Eamil</td>
                            <td>
                                <a href="{{ url('admin/emails/veerra_fied_email') }}" class="btn btn-primary active">Edit Email</a>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @endsection
