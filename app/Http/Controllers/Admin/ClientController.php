<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('order')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/clients'), $filename);
            $data['logo'] = 'uploads/clients/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->order ?? 0;

        Client::create($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client added successfully!');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($client->logo && file_exists(public_path($client->logo))) {
                unlink(public_path($client->logo));
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/clients'), $filename);
            $data['logo'] = 'uploads/clients/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->order ?? 0;

        $client->update($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully!');
    }

    public function destroy(Client $client)
    {
        // Delete logo file
        if ($client->logo && file_exists(public_path($client->logo))) {
            unlink(public_path($client->logo));
        }

        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully!');
    }
}
