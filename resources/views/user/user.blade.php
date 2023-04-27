@extends('layouts.app')

@section('header')
    <div class="col-sm-6">
        <h1 class="m-0">
            User
        </h1>
    </div>
    <div class="col-sm-6">
        <a class="btn btn-lg btn-primary" style="float:right !important;" data-bs-toggle="modal" data-bs-target="#createUserModal">Create User</a>
    </div>
@endsection

@section('content')
    <div class="table-responsive mt-2">
        <table id="user-table" class="table  table-striped" style="width:100% !important;">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Two Factor Auth</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if($user->hasRole('user'))
                        <tr id="userRow{{$user->id}}">
                            <th>{{ $user->name }}</th>
                            <th>{{ $user->email }}</th>
                            <th>
                                @if($user->status == 'active')
                                    <span class="badge badge-success">Active</span>
                                @elseif ($user->status == 'block')
                                    <span class="badge badge-danger">Block</span>
                                @else
                                    <span class="badge badge-warning">Assign</span>
                                @endif
                            </th>
                            <th>
                                @if($user->two_factor_secret)
                                    <span class="badge badge-success">Enabled</span>
                                @else
                                    <span class="badge badge-danger">Disabled</span>
                                @endif
                            </th>
                            <th >
                                <div class="float-right">
                                    <a href="javascript:void(0)" onclick="deleteUser({{$user->id}})"><i class="fas fa-trash ml-2 mr-2" style="color: #dc3545"></i></a>
                                    <a href="javascript:void(0)" onclick="changeUserStatus({{$user->id}})"><i class="fas fa-ban ml-2 mr-2" style="color: #ffc107"></i></a>
                                </div>
                            </th>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    @include('user.modals.create')
    @include('user.modals.delete')
    @include('user.modals.block')
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#user-table').DataTable({
            processing: true,
            dom: 'tp'
        });
    });
</script>
<script src="{{ asset('js/user.js')}}" ></script>
@endsection
