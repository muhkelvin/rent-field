<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldCategory;
use Illuminate\Http\Request;

class CustomerFieldController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua kategori
        $categories = FieldCategory::all();

        // Membuat query untuk Field
        $fields = Field::query();

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $fields->where('field_category_id', $request->category);
        }

        // Filter berdasarkan lokasi
        if ($request->filled('location')) {
            $fields->where('address', 'like', '%' . $request->location . '%');
        }

        // Filter dan sort berdasarkan harga
        if ($request->filled('price')) {
            $fields->orderBy('price', $request->price);
        }

        // Eksekusi query dan kirim ke view
        return view('customer.fields.index', [
            'fields' => $fields->get(),
            'categories' => $categories,
        ]);
    }

    public function show(Field $field)
    {
        // Kirim Field ke view
        return view('customer.fields.show', compact('field'));
    }
}

