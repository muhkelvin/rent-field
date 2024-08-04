<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerFieldController extends Controller
{
    public function index()
    {
        $fields = Field::where('user_id', Auth::id())->get();
        return view('owner.fields.index', compact('fields'));
    }

    public function create()
    {
        $categories = FieldCategory::all();
        return view('owner.fields.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'field_category_id' => 'required|exists:field_categories,id',
        ]);

        Field::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'address' => $request->address,
            'field_category_id' => $request->field_category_id,
        ]);

        return redirect()->route('owner.fields.index')->with('success', 'Field created successfully');
    }

    public function edit(Field $field)
    {
        if ($field->user_id !== Auth::id()) {
            return redirect()->route('owner.fields.index')->with('error', 'Unauthorized access to edit this field.');
        }

        $categories = FieldCategory::all();
        return view('owner.fields.edit', compact('field', 'categories'));
    }

    public function update(Request $request, Field $field)
    {
        if ($field->user_id !== Auth::id()) {
            return redirect()->route('owner.fields.index')->with('error', 'Unauthorized access to update this field.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'field_category_id' => 'required|exists:field_categories,id',
        ]);

        $field->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'address' => $request->address,
            'field_category_id' => $request->field_category_id,
        ]);

        return redirect()->route('owner.fields.index')->with('success', 'Field updated successfully');
    }

    public function destroy(Field $field)
    {
        if ($field->user_id !== Auth::id()) {
            return redirect()->route('owner.fields.index')->with('error', 'Unauthorized access to delete this field.');
        }

        $field->delete();
        return redirect()->route('owner.fields.index')->with('success', 'Field deleted successfully');
    }
}
