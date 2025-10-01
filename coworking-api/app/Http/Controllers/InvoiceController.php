<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'meta' => 'nullable|array',
        ]);

        $payment = Payment::findOrFail($validated['payment_id']);
        if ($payment->status !== 'paid') {
            return response()->json([
                'message' => 'No se puede emitir factura, el pago no está confirmado.'
            ], 422);
        }

        $invoiceNumber = 'INV-' . strtoupper(Str::random(8));

        $invoice = Invoice::create([
            'payment_id' => $validated['payment_id'],
            'number' => $invoiceNumber,
            'issued_date' => now()->toDateString(),
           'meta' => json_encode($request->meta),
        ]);

        return response()->json([
            'message' => 'Factura emitida con éxito',
            'invoice' => $invoice
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
