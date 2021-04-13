<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ikram</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td align="right">
            <h3>Kellton Ikram Invoice</h3>
            <pre>
                Hyderabad
                9492925000
            </pre>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td><strong>From:</strong> Balwari Ikram</td>
        <td><strong>To:</strong> {{$invoice['customer_name']}}</td>
        <td><strong>Date:</strong> {{$invoice['date']}}</td>
        <td><strong>Invoice Id:</strong> {{$invoice['id']}}</td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">

    <tr>
        <th>#</th>
        <th>Description</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
    @foreach($invoice['line_items'] as $item)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{$item['description']}}</td>
        <td align="right">{{$item['amount']}}</td>
      </tr>
      @endforeach
      <tr>
          <td></td>
          <td>Total Cost</td>
          <td align="right">{{$invoice['currency']}} {{$invoice['total_cost']}}</td>
      </tr>
  </table>

</body>
</html>
