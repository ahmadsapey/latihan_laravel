<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingNavItem;
use Illuminate\Http\Request;

class LandingNavController extends Controller
{
    public function index()
    {
        $items = LandingNavItem::orderBy('order')->get();
        return view('admin.landing.nav.index', compact('items'));
    }

    public function create()
    {
        return view('admin.landing.nav.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'url' => 'required',
            'order' => 'required|integer',
        ]);

        LandingNavItem::create($request->all());
        return redirect()->route('admin.landing.navigation.index')->with('success', 'Menu created');
    }

    public function edit($id)
    {
        $item = LandingNavItem::findOrFail($id);
        return view('admin.landing.nav.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = LandingNavItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.landing.navigation.index')->with('success', 'Menu updated');
    }

    public function destroy($id)
    {
        LandingNavItem::destroy($id);
        return back()->with('success', 'Menu deleted');
    }
}