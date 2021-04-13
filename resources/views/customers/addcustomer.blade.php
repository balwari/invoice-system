@extends('layouts.app')

@section('content')
<div class="container-fluid">
@isset($success)
<div class="col-md-6 alert alert-success alert-dismissible fade show">
    <strong>{{$success}}</strong>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endisset
    <h3 style="text-align:center;">Add Customer</h3>

    <ul class="breadcrumb">
        <li><a href="{{route('all')}}">Home </a></li> /
        <li>Add Customer</li>
    </ul>

    <div class="container">
        <form class="form-horizontal" method="POST" action="{{route('create-customer')}}">
            {{ csrf_field() }}

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Description:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" placeholder="Enter Description" required></textarea>
                            </div>
                        </div>
                    </div>
            <div class="col-md-12">
                <div class="col-md-2 offset-md-5">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </div>
            </div>
        </form>
        <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->description }}</td>
                <td>
                <div class="btn-group btn-group-sm" role="group" aria-label="Option">
                        <button type="button" class="btn btn-info" onClick="location.href='{{ route('get-customer', ['id'=>$customer->id]) }}'">
                            Add Details
                        </button>
                    </div>
                </td>
            <tr>
                @endforeach
        </tbody>
    </table>

    </div>
</div>

@endsection