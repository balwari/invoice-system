<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Detail;
use App\Models\Invoice;
use Auth;
use PDF;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.addcustomer')->with('customers', $customers);
    }

    public function create(Request $request)
    {
        $customer = $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'required',
        ]);

        $create = Customer::create($customer);

        $success = "Successfully added Customer";
        $customers = Customer::all();

        return view('customers.addcustomer')->with('success', $success)
            ->with('customers', $customers);
    }

    public function getCustomer($id)
    {
        $customer = Customer::find($id);
        $details = Detail::where('customer_id', $id)->get();
        return view('customers.adddetails')->with('id', $id)
            ->with('details', $details);
    }

    public function addDetails(Request $request)
    {
        // $customer = Customer::find($request->id);
        // return view('debug')->with('debug',$customer['id']);

        for ($i = 0; $i < sizeof($request->address); $i++) {
            
            $detail['customer_id'] = $request->id;
            $detail['address'] = $request->address[$i];
            $detail['state'] = $request->state[$i];
            $detail['city'] = $request->city[$i];
            $detail['zipcode'] = $request->zipcode[$i];
            $detail['bank_name'] = $request->bank_name[$i];
            $detail['bank_address'] = $request->bank_address[$i];
            $detail['contact'] = $request->contact[$i];

            // return view('debug')->with('debug',$detail['address']);
            Detail::create($detail);
            $detail = [];

        }
        return redirect()->back();
    }

    public function getDetail($id)
    {
        // return view('debug')->with('debug',$id);

        $detail = Detail::find($id);
        $invoices = Invoice::where('customer_id', $detail['customer_id'])->get();
        return view('customers.addinvoices')->with('id', $id)
            ->with('invoices', $invoices);
    }

    public function addInvoices(Request $request)
    {
        // $customer = Customer::find($request->id);
        // return view('debug')->with('debug',$request->id);

        $invoice['total_cost'] = 0;

        $invoice['line_items'] = [];

        for ($i = 0; $i < sizeof($request->description); $i++) {
            $data['description'] = $request->description[$i];
            $data['amount'] = $request->amount[$i];

            $invoice['total_cost'] = $invoice['total_cost'] + $request->amount[$i];

            array_push($invoice['line_items'],$data);

            $data = [];
        }

        $detail = Detail::find($request->id);

        $invoice['customer_id'] = $detail['customer_id'];
        $invoice['detail_id'] = $request->id;
        $invoice['date'] = $request->date;
        $invoice['currency'] = $request->currency;
        Invoice::create($invoice);
        $invoices = Invoice::where('customer_id', $detail['customer_id'])->get();

        return view('customers.addinvoices')->with('id', $detail['id'])
            ->with('invoices', $invoices);
    }

    public function getInvoice($id)
    {

        $invoice = Invoice::find($id);

        $customer = Customer::where('id',$invoice['customer_id'])->first();
        $invoice['customer_name'] = $customer['name'];

        // return view('debug')->with('debug',gettype($invoice['line_items']));
        // return view('debug')->with('debug',$invoice['line_items'][0]);

        // $invoice['items'] = [];
        // foreach($invoice['line_items'] as $item){
        //     $data['description'] = $item['description'];
        //     $data['amount'] = $item['amount'];
        //     array_push($invoice['items'],$data);
        //     $data = [];
        // }

        view()->share('invoice', $invoice);
        $pdf = PDF::loadView('pdf.template');
        // return $pdf->stream();
        return $pdf->download('invoice.pdf');

        // return $pdf->getPdf('download');
        // return view('customers.addinvoices')->with('id', $id)
        //     ->with('invoices', $invoices);
    }

}
