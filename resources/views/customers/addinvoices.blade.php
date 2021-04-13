@extends('layouts.app')

@section('content')
<script>
    function addRow() {
        var tr = '<tr>' +
            '<td><input type="text" name="description[]" class="form-control" required></td>' +
            '<td><input type="number" name="amount[]" id="amount[]" onkeyup="calculate()" class="form-control" required></td>' +
            '</tr>';
        $('#dynamic').append(tr);
    }

    function removeRow() {
        $('#dynamic tr:last').remove();

        calculate();

    }

    function calculate() {
        var amounts = document.querySelectorAll("input[id='amount[]'");

        var total = 0;
  
        for (var i = 0; i < amounts.length; i++){

            total = total + +amounts[i].value ;
        }

          document.getElementById('total_cost').value = total;
    }
</script>
<div class="container-fluid">
    @isset($success)
    <div class="col-md-6 alert alert-success alert-dismissible fade show">
        <strong>{{$success}}</strong>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endisset
    <h3 style="text-align:center;">Add Invoices</h3>

    <ul class="breadcrumb">
        <li><a href="{{route('all')}}">Home </a></li> /
        <li><a href="{{route('add-customer')}}">Add Customer </a></li> /
        <li>Add Invoice</li>
    </ul>
    <div class="col-md-12 mb-1">
        <button onclick="addRow()" class="btn btn-info"><i class="fas fa-plus">ADD</i></button>
        <button onclick="removeRow()" class="btn btn-info"><i class="fas fa-plus">Remove</i></button>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('add-invoices') }}">
        {{ csrf_field() }}
<input type="hidden" value="{{ $id }}" name="id">
<div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="name">Date:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Currency:</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="currency" required>
                                    <option value="INR">Indian Rupee</option>
                                    <option value="USD">US Dollar</option>
                                    <option value="POUND">UK Pound</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Total Cost:</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="total_cost" id="total_cost" required readonly>
                            </div>
                        </div>
                    </div>

                </div>
</div>
<div class="col-md-12">
            <table class="table table-bordered" id="dynamic">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="description[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="amount[]" id ="amount[]" onkeyup="calculate()" class="form-control" required>
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
                <th>Customer ID</th>
                <th>Detail Id</th>
                <th>Currency</th>
                <th>Total Cost</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $invoice->customer_id }}</td>
                <td>{{ $invoice->detail_id }}</td>
                <td>{{ $invoice->currency }}</td>
                <td>{{ $invoice->total_cost }}</td>
                <td>{{ $invoice->date }}</td>
                <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Option">
                        <button type="button" class="btn btn-info" onClick="location.href='{{ route('get-invoice', ['id'=>$invoice->id]) }}'">
                            Download
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