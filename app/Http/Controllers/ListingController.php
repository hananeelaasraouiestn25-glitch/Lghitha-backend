<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return Listing::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:job,service',
            'title' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:20|max:500',
            'location' => 'nullable|string|max:100',
            'price' => 'nullable|string|max:50',
            'contact' => 'required|regex:/^(\+213)?0?[5-7][0-9]{8}$/',
        ]);

        $validated['status'] = 'approved';
        $validated['reports'] = 0;

        $listing = Listing::create($validated);

        return response()->json($listing, 201);
    }

    public function update(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,approved,hidden',
        ]);
        $listing->update($validated);
        return response()->json($listing);
    }

    public function destroy($id)
    {
        Listing::findOrFail($id)->delete();
        return response()->json(['message' => 'محذوف']);
    }

    public function report($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->increment('reports');
        if ($listing->reports >= 3) {
            $listing->update(['status' => 'hidden']);
        }
        return response()->json($listing);
    }

    public function adminIndex()
    {
        return Listing::orderBy('created_at', 'desc')->get();
    }
}