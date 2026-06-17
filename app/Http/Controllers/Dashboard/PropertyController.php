<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Property\PropertyStoreRequest;
use App\Http\Requests\Dashboard\Property\PropertyUpdateRequest;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('dashboard.properties.index', compact('properties'));
    }

    public function store(PropertyStoreRequest $request)
    {
        Property::create([
            'name' => $request->name
        ]);

        toastr()->success('بنجاح', 'تم حفظ البيانات');

        return back();
    }

    public function edit(Property $property)
    {
        return view('dashboard.properties.edit', compact('property'));
    }

    public function update(PropertyUpdateRequest $request, Property $property)
    {
        $property->update([
            'name' => $request->name
        ]);

        toastr()->success('بنجاح', 'تم تعديل البيانات');

        return to_route('properties.index');
    }
}
