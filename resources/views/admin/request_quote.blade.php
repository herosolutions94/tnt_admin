@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
@if (request()->segment(3) == 'view')
{!! breadcrumb('View Request Quote') !!}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border shadow-none">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-3">Request Quote Details</h4>
                        <div class="d-flex align-items-center justify-content-between pb-7">
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">Full Name</h5>
                            </div>
                            <p class="mb-0">
                                <td>{{ "{$row->fname} {$row->lname}" }}</td>
                            </p>
                        </div>

                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">Phone Number</h5>
                            </div>
                            <p class="mb-0">{{ $row->phone }}</p>
                        </div>

                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">Email</h5>
                            </div>
                            <p class="mb-0">{{ $row->email }}</p>
                        </div>

                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">Address</h5>
                            </div>
                            <p class="mb-0">{{ $row->address }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">Pool Type</h5>
                            </div>
                            <p class="mb-0">{{ $row->pool_type }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">What stage are you at in the process?</h5>
                            </div>
                            <p class="mb-0">{{ $row->stage }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">Project Timeline</h5>
                            </div>
                            <p class="mb-0">{{ $row->timeline }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">What is your estimated budget for this project?</h5>
                            </div>
                            <p class="mb-0">{{ $row->budget }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                            <div>
                                <h5 class="fs-4 fw-semibold mb-0">Anything else we should know?</h5>
                            </div>
                            <p class="mb-0">{{ $row->anything_else }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
{!! breadcrumb('Request Quotes') !!}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                    <thead>
                        <!-- start row -->
                        <tr>

                            <th>Sr#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        <!-- end row -->
                    </thead>
                    <tbody>
                        @if (!empty($rows))
                        @foreach ($rows as $key => $row)
                        <tr>
                            <td class="sorting_1">{{ $key + 1 }}</td>
                            <td>{{ "{$row->fname} {$row->lname}" }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->address }}</td>
                            <td>{!! getReadStatus($row->status) !!}</td>
                            <td>
                                <div class="dropdown dropstart">
                                    <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical fs-6"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                href="{{ url('admin/request-quote/view/' . $row->id) }}">
                                                <i class="fs-4 ti ti-eye"></i>View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                href="{{ url('admin/request-quote/delete/' . $row->id) }}"
                                                onclick="return confirm('Are you sure?');">
                                                <i class="fs-4 ti ti-trash"></i>Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4">No record(s) found!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection