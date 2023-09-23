<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachements;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(invoices_details $invoices_details)
    {
        //
    }

    public function edit($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $details  = invoices_Details::where('id_Invoice',$id)->get();
        $attachments  = invoice_attachements::where('invoice_id',$id)->get();

        return view('invoices.details_invoice',compact('invoices','details','attachments'));
    }

    
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    
    public function destroy(Request $request)
    { //supprimer dans la bd
        $invoices = invoice_attachements::findOrFail($request->id_file);
        $invoices->delete();
        //supprimer dans server public attachements
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
        
    }

    


    public function get_file($invoice_number,$file_name)
        {
        $st="Attachments";
        $pathToFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
        return response()->download($pathToFile);
        }
        
        public function open_file($invoice_number,$file_name)
        {
        $st="Attachments";
        $pathToFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
        return response()->file($pathToFile);
        }
}
