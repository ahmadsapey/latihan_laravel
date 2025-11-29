<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LandingFooterLink;
use Illuminate\Http\Request;

class LandingFooterController extends Controller
{
    /**
     * Display a listing of the footer links.
     */
    public function index()
    {
        $links = LandingFooterLink::orderBy('position')->get();
        return view('admin.landing.footer.index', compact('links'));
    }

    /**
     * Show form to create a new footer link.
     */
    public function create()
    {
        return view('admin.landing.footer.create');
    }

    /**
     * Store new footer link.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'url'   => 'nullable|url|max:255',
            'status'=> 'required|boolean'
        ]);

        $position = LandingFooterLink::max('position') + 1;

        LandingFooterLink::create([
            'label'    => $request->label,
            'url'      => $request->url,
            'position' => $position,
            'status'   => $request->status,
        ]);

        return redirect()->route('admin.landing.footer.index')
            ->with('success', 'Footer link berhasil ditambahkan.');
    }

    /**
     * Show form to edit a footer link.
     */
    public function edit($id)
    {
        $footer = LandingFooterLink::findOrFail($id);
        return view('admin.landing.footer.edit', compact('footer'));
    }

    /**
     * Update footer link.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'url'   => 'nullable|url|max:255',
            'status'=> 'required|boolean'
        ]);

        $footer = LandingFooterLink::findOrFail($id);
        $footer->update([
            'label'    => $request->label,
            'url'      => $request->url,
            'status'   => $request->status,
        ]);

        return redirect()->route('admin.landing.footer.index')
            ->with('success', 'Footer link berhasil diperbarui.');
    }

    /**
     * Delete footer link.
     */
    public function destroy($id)
    {
        $footer = LandingFooterLink::findOrFail($id);
        $footer->delete();

        return redirect()->route('admin.landing.footer.index')
            ->with('success', 'Footer link berhasil dihapus.');
    }

    /**
     * Update sorting order (AJAX optional).
     */
    public function reorder(Request $request)
    {
        foreach ($request->order as $order) {
            LandingFooterLink::where('id', $order['id'])
                ->update(['position' => $order['position']]);
        }

        return response()->json(['message' => 'Urutan footer berhasil diperbarui']);
    }

    /**
     * Toggle active/inactive status (optional).
     */
    public function toggleStatus($id)
    {
        $footer = LandingFooterLink::findOrFail($id);
        $footer->status = !$footer->status;
        $footer->save();

        return redirect()->route('admin.landing.footer.index')
            ->with('success', 'Status footer berhasil diperbarui.');
    }
}