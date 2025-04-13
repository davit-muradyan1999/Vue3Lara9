<?php

namespace App\Http\Controllers;

use App\Models\AuthenticityCheck;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AuthenticityCheckImport;
use App\Models\Product;

class AuthenticityCheckController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $authCheck = AuthenticityCheck::latest()->get();
        return view('authenticity_checks.index', compact('authCheck', 'products'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new AuthenticityCheckImport, $request->file('file'));
            return redirect()->route('authenticity.index')->with('success', 'Товары успешно загружены.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $product = AuthenticityCheck::findOrFail($id);
        $product->update($request->only([
            'product_id', 'barcode', 'title', 'item', 'gold', 'silver', 'stone',
            'other_materials', 'price_exclusive', 'handcrafted', 'exclusive_edition'
        ]));

        return redirect()->route('authenticity.index')->with('success', 'Update successfully.');
    }

    public function destroy($id)
    {
        $product = AuthenticityCheck::findOrFail($id);
        $product->delete();

        return redirect()->route('authenticity.index')->with('success', 'Delete successfully.');
    }
}
