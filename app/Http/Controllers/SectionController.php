<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SectionController extends Controller
{
    private $product;
    private $section;

    public function __construct(Product $product, Section $section)
    {
        $this->product = $product;
        $this->section = $section;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_sections = $this->section->oldest()->get();

        return view('products.add-section')
                ->with('all_sections', $all_sections);
    }

    public function store(Request $request)
    {
        # Validate the request
        $request->validate([
            'title' => 'required|min:1|max:50',
        ]);

        # Save the request to the database
        $this->section->title      = $request->title;
        $this->section->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $section = $this->section->findOrFail($id);

        // 関連する製品を削除
        $section->product()->delete();

        // セクションを削除
        $section->delete();

        return redirect()->back();
    }

}
