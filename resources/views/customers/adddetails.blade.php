@extends('layouts.app')

@section('content')
<script>
    function addRow() {
        var tr = '<tr>' +
            '<td><input type="text" name="address[]" class="form-control"></td>' +
            '<td><input type="text" name="state[]" class="form-control"></td>' +
            '<td><input type="text" name="city[]" class="form-control"></td>' +
            '<td><input type="text" name="zipcode[]" class="form-control"></td>' +
            '<td><input type="text" name="bank_name[]" class="form-control"></td>' +
            '<td><input type="text" name="bank_address[]" class="form-control"></td>' +
            '<td><input type="text" name="contact[]" class="form-control"></td>' +
            '</tr>';
        $('#dynamic').append(tr);
    }

    function removeRow() {
        $('#dynamic tr:last').remove();
    }
</script>
<div class="container-fluid">
    @isset($success)
    <div class="col-md-6 alert alert-success alert-dismissible fade show">
        <strong>{{$success}}</strong>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endisset
    <h3 style="text-align:center;">Add Customer Details</h3>

    <ul class="breadcrumb">
        <li><a href="{{route('all')}}">Home </a></li> /
        <li><a href="{{route('add-customer')}}">Add Customer </a></li> /
        <li>Add Customer Details</li>
    </ul>
    <div class="col-md-12 mb-1">
        <button onclick="addRow()" class="btn btn-info"><i class="fas fa-plus">ADD</i></button>
        <button onclick="removeRow()" class="btn btn-info"><i class="fas fa-plus">Remove</i></button>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('add-details') }}">
        {{ csrf_field() }}
<input type="hidden" value="{{ $id }}" name="id">
        <div class="col-md-12">
            <table class="table table-bordered" id="dynamic">
                <thead>
                    <tr>
                        <th>Address</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Zipcode</th>
                        <th>Bank Name</th>
                        <th>Bank Address</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="address[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="state[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="city[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="zipcode[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="bank_name[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="bank_address[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="contact[]" class="form-control" required>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                <th>Address</th>
                <th>State</th>
                <th>City</th>
                <th>Zipcode</th>
                <th>Bank Name</th>
                <th>Bank Address</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->address }}</td>
                <td>{{ $detail->state }}</td>
                <td>{{ $detail->city }}</td>
                <td>{{ $detail->zipcode }}</td>
                <td>{{ $detail->bank_name }}</td>
                <td>{{ $detail->bank_address }}</td>
                <td>{{ $detail->contact }}</td>
                <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Option">
                        <button type="button" class="btn btn-info" onClick="location.href='{{ route('get-detail', ['id'=>$detail->id]) }}'">
                            Add Invoice
                        </button>
                    </div>
                        </td>            <tr>
                @endforeach
        </tbody>
    </table>

</div>
</div>

@endsection