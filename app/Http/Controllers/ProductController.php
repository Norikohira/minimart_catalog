<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
        $all_products = $this->product->oldest()->get();

        return view('products.index')
                ->with('all_products', $all_products);
    }

    /**
    ** Show the form for creating a new resource.
    */
    public function create()
    {
        $all_sections = $this->section->oldest()->get();

        return view('products.add-product')
                ->with('all_sections', $all_sections);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validate the request
        $request->validate([
            'title' => 'required|min:1|max:50',
            'description'  => 'required|min:1|max:1000',
            'price' => 'required|min:1|max:50',
        ]);

        $this->product->title           = $request->title;
        $this->product->description     = $request->description;
        $this->product->price           = $request->price;
        $this->product->section_id      = $request->section_id;

        $this->product->save();

        # Redirect to homepage
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->product->findOrFail($id);

        return view('products.delete')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = $this->product->findOrFail($id);

        $all_sections = $this->section->oldest()->get();

        return view('products.edit')->with('product', $product)->with('all_sections', $all_sections);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:1|max:50',
            'description'  => 'required|min:1|max:1000',
            'price' => 'required|min:1|max:50',
        ]);

        $product                    = $this->product->findOrFail($id);
        $product->title             = $request->title;
        $product->description       = $request->description;
        $product->price             = $request->price;
        $product->section_id        = $request->section_id;

        $product->save();

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);

        $product->delete();

        return redirect()->route('index');
    }
}
