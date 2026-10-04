<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EstimatorType;
use App\Models\EstimatorPackage;
use App\Models\EstimatorAddon;
use Illuminate\Http\Request;

class EstimatorController extends Controller
{
    // ─── Types ───────────────────────────────────────────────

    public function index()
    {
        $types = EstimatorType::orderBy('order')->with('packages', 'addons')->get();
        return view('admin.estimator.index', compact('types'));
    }

    public function createType()
    {
        return view('admin.estimator.type-form', ['type' => null]);
    }

    public function storeType(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|max:100',
            'icon'       => 'nullable|max:10',
            'base_price' => 'required|integer|min:0',
            'order'      => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        EstimatorType::create($validated);

        return redirect()->route('admin.estimator.index')->with('success', 'Type created!');
    }

    public function editType(EstimatorType $type)
    {
        return view('admin.estimator.type-form', compact('type'));
    }

    public function updateType(Request $request, EstimatorType $type)
    {
        $validated = $request->validate([
            'name'       => 'required|max:100',
            'icon'       => 'nullable|max:10',
            'base_price' => 'required|integer|min:0',
            'order'      => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $type->update($validated);

        return redirect()->route('admin.estimator.index')->with('success', 'Type updated!');
    }

    public function destroyType(EstimatorType $type)
    {
        $type->delete(); // cascades to packages & addons
        return redirect()->route('admin.estimator.index')->with('success', 'Type deleted!');
    }

    // ─── Packages ────────────────────────────────────────────

    public function packagesIndex(EstimatorType $type)
    {
        $packages = $type->packages;
        return view('admin.estimator.packages', compact('type', 'packages'));
    }

    public function storePackage(Request $request, EstimatorType $type)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable|max:500',
            'price'       => 'required|integer|min:0',
            'order'       => 'nullable|integer',
        ]);
        $validated['per_head']          = $request->has('per_head') ? 1 : 0;
        $validated['estimator_type_id'] = $type->id;

        EstimatorPackage::create($validated);

        return redirect()->route('admin.estimator.packages', $type)->with('success', 'Package added!');
    }

    public function updatePackage(Request $request, EstimatorType $type, EstimatorPackage $package)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable|max:500',
            'price'       => 'required|integer|min:0',
            'order'       => 'nullable|integer',
        ]);
        $validated['per_head'] = $request->has('per_head') ? 1 : 0;

        $package->update($validated);

        return redirect()->route('admin.estimator.packages', $type)->with('success', 'Package updated!');
    }

    public function destroyPackage(EstimatorType $type, EstimatorPackage $package)
    {
        $package->delete();
        return redirect()->route('admin.estimator.packages', $type)->with('success', 'Package deleted!');
    }

    // ─── Add-ons ─────────────────────────────────────────────

    public function addonsIndex(EstimatorType $type)
    {
        $addons = $type->addons;
        return view('admin.estimator.addons', compact('type', 'addons'));
    }

    public function storeAddon(Request $request, EstimatorType $type)
    {
        $validated = $request->validate([
            'name'  => 'required|max:255',
            'price' => 'required|integer|min:0',
            'order' => 'nullable|integer',
        ]);
        $validated['is_active']         = $request->has('is_active') ? 1 : 0;
        $validated['estimator_type_id'] = $type->id;

        EstimatorAddon::create($validated);

        return redirect()->route('admin.estimator.addons', $type)->with('success', 'Add-on added!');
    }

    public function updateAddon(Request $request, EstimatorType $type, EstimatorAddon $addon)
    {
        $validated = $request->validate([
            'name'  => 'required|max:255',
            'price' => 'required|integer|min:0',
            'order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $addon->update($validated);

        return redirect()->route('admin.estimator.addons', $type)->with('success', 'Add-on updated!');
    }

    public function destroyAddon(EstimatorType $type, EstimatorAddon $addon)
    {
        $addon->delete();
        return redirect()->route('admin.estimator.addons', $type)->with('success', 'Add-on deleted!');
    }
}
