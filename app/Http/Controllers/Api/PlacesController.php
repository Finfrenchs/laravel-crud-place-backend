<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Places;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlacesController extends Controller
{
    public function index()
    {
        $places = Places::all();
        return response()->json([
            'data' => $places,
            'message' => 'Daftar tempat berhasil diambil',
            'status' => 'success'
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'coordinates' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/places', $imageName);
            $data['image'] = $imageName;
        }

        $place = Places::create($data);
        if ($place) {
            return response()->json([
                'success' => true,
                'message' => 'Place Created',
                'data' => $place
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Place Failed to Save',
            ], 409);
        };
    }

    public function show($id)
    {
        $place = Places::findOrFail($id);
        return response()->json([
            'data' => $place,
            'message' => 'Daftar tempat berhasil diambil',
            'status' => 'success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'coordinates' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $place = Places::findOrFail($id);

        $place->name = $request->name;
        $place->address = $request->address;
        $place->coordinates = $request->coordinates;
        $place->description = $request->description;

        if ($request->hasFile('image')) {
            if ($place->image) {
                Storage::disk('public')->delete('places/' . $place->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $image = $request->file('image');
            $image->storeAs('public/places', $imageName);
            $place->image = $imageName;
        }

        $place->save();


        return response()->json([
            'message' => 'Place updated successfully',
            'data' => $place
        ], 200);
    }


    public function destroy($id)
    {
        $place = Places::findOrFail($id);

        // Delete image if it exists
        if ($place->image) {
            Storage::disk('public')->delete($place->image);
        }

        $place->delete();

        return response()->json([
            'success' => true,
            'message' => 'Place deleted successfully'], 200);
    }
}
