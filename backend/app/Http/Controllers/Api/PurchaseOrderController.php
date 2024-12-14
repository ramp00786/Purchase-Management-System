<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{
    
    public function submit_purchase(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'supplier_id'  => 'required|exists:suppliers,id',
            'products'     => 'required|array',
            'products.*'   => 'required|array', // Ensure each product is valid
            'total_price'  => 'required|numeric|min:0',
        ]);

        try {
            // Create a new purchase order
            $purchaseOrder = PurchaseOrder::create([
                'supplier_id' => $validated['supplier_id'],
                'products'    => $validated['products'],
                'total_price' => $validated['total_price'],
            ]);

            // Return a success response
            return response()->json([
                'message' => 'Purchase order submitted successfully.',
                'data'    => $purchaseOrder,
            ], 201);

        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'message' => 'Failed to submit purchase order.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function getInvoice($id)
    {
        // Get the PurchaseOrder by ID, loading the related supplier
        $purchase = PurchaseOrder::with('supplier')->findOrFail($id);

        // Prepare response with invoice details
        $invoice = [
            'id' => $purchase->id,
            'supplier' => [
                'name' => $purchase->supplier->name,
                'address' => $purchase->supplier->address,
                'contact' => $purchase->supplier->contact,
            ],
            'date' => $purchase->created_at->toDateString(),  // Formatting the date
            'products' => [],
            'sub_total' => 0,
            'gst' => 0,
            'total_price' => $purchase->total_price,
        ];

        // Map over the products stored in the 'products' JSON column of the PurchaseOrder
        foreach ($purchase->products as $product) {
            // Adding product data to the invoice, and calculating costs
            $quantity = $product['quantity'];
            $price = $product['price'];

            $invoice['products'][] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $price,
                'quantity' => $quantity,
                'total' => $price * $quantity,
                'gst' => ($price * 0.18) * $quantity,  // Calculating GST at 18%
            ];

            // Sum sub-total and GST
            $invoice['sub_total'] += $price * $quantity;
            $invoice['gst'] += ($price * 0.18) * $quantity;
        }

        // Return JSON response with invoice details
        return response()->json($invoice);
    }


    public function getAllPurchase()
    {
        // Get all purchase orders, including the related suppliers
        $purchases = PurchaseOrder::with('supplier')->get();

        // Prepare response with summarized purchase order details
        $purchaseOrders = $purchases->map(function ($purchase) {
            return [
                'id' => $purchase->id,
                'supplier' => [
                    'name' => $purchase->supplier->name,
                    'contact' => $purchase->supplier->contact,
                ],
                'date' => $purchase->created_at->toDateString(), // Formatting the date
                'total_products' => collect($purchase->products)->sum('quantity'),
                'sub_total' => collect($purchase->products)->reduce(function ($total, $product) {
                    return $total + ($product['price'] * $product['quantity']);
                }, 0),
                'gst' => collect($purchase->products)->reduce(function ($total, $product) {
                    return $total + (($product['price'] * 0.18) * $product['quantity']);
                }, 0),
                'total_price' => $purchase->total_price,
            ];
        });

        // Return JSON response with all purchase orders
        return response()->json($purchaseOrders);
    }

    
}
