<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\categories;
use Illuminate\Support\Str;
use Session; 
use File; 

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.index");
    }
    public function brands_index()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view("admin.brands",compact('brands'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function add_brand()
    {
        return view('admin.brand-add'); // Show the create brand form
    }

    /**
     * Store a newly created brand in storage.
     */
    public function brand_store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|unique:brands,name', // Brand name is required and must be unique
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name); // Generate slug from name

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename
            $file->move(public_path('uploads/brands'), $filename); // Save image to 'public/uploads/brands'
            $brand->image = $filename; // Store filename in database
        }

        $brand->save(); // Save brand to database

        Session::flash('success', 'Brand created successfully!'); // Flash success message
        return redirect()->route('admin.brands'); // Redirect to brands list
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit_brand($id)
{
    $brand = Brand::find($id); // Use find() instead of findOrFail() temporarily

    if (!$brand) {
        // Brand not found
        abort(404); // Manually trigger a 404 error for clarity
    }

    return view('admin.brand-edit', compact('brand'));
}

    /**
     * Update the specified brand in storage.
     */
    public function update_brand(Request $request, $id) // Accept the ID of the brand as a parameter
{
    // Find the brand using the provided ID. If not found, throw a 404 error.
    $brand = Brand::findOrFail($id);

    // Validate incoming request data
    $request->validate([
        'name' => 'required|unique:brands,name,' . $brand->id, // Brand name is required and must be unique except for the current brand
        'slug' => 'required|unique:brands,slug,'.$request->id,
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size
    ]);

    // Update brand name and slug
    $brand->name = $request->name; // Set the name from the request
    $brand->slug = Str::slug($request->name); // Generate a slug from the brand name

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($brand->image && File::exists(public_path('uploads/brands/' . $brand->image))) {
            File::delete(public_path('uploads/brands/' . $brand->image)); // Remove the old image file
        }

        // Handle new image upload
        $file = $request->file('image'); // Get the uploaded file
        $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate a unique filename
        $file->move(public_path('uploads/brands'), $filename); // Move the uploaded file to the desired directory
        $brand->image = $filename; // Update the brand's image path
    }

    $brand->save(); // Save changes to the database

    // Flash a success message to indicate the brand was updated
    Session::flash('success', 'Brand updated successfully!');

    // Redirect the user back to the brand index page
    return redirect()->route('admin.brands');
}

    /**
     * Remove the specified brand from storage.
     */
    public function delete_brand($id) // Accept the ID of the brand as a parameter
    {
        // Find the brand using the provided ID. If not found, throw a 404 error.
        $brand = Brand::findOrFail($id);
    
        // Check if the brand has an image
        if ($brand->image && File::exists(public_path('uploads/brands/' . $brand->image))) {
            // If the image exists, delete the image file from the server
            File::delete(public_path('uploads/brands/' . $brand->image));
        }
    
        // Delete the brand from the database
        $brand->delete();
    
        // Flash a success message to the session to indicate the brand was deleted
        Session::flash('success', 'Brand deleted successfully!');
    
        // Redirect the user back to the brand index page
        return redirect()->route('admin.brands');
    }
    // Categories
    public function categories_index()
    {
        $Categories = categories::orderBy('id','DESC')->paginate(10);
        return view("admin.categories",compact('categories'));
    }
    // Categories add
    public function Categories_brand()
    {
        return view('admin.categories-add'); // Show the create brand form
    }
    // categories store
    public function categories_store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|unique:brands,name', // Brand name is required and must be unique
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name); // Generate slug from name

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename
            $file->move(public_path('uploads/brands'), $filename); // Save image to 'public/uploads/brands'
            $brand->image = $filename; // Store filename in database
        }

        $brand->save(); // Save brand to database

        Session::flash('success', 'Brand created successfully!'); // Flash success message
        return redirect()->route('admin.brands'); // Redirect to brands list
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit_brand($id)
{
    $brand = Brand::find($id); // Use find() instead of findOrFail() temporarily

    if (!$brand) {
        // Brand not found
        abort(404); // Manually trigger a 404 error for clarity
    }

    return view('admin.brand-edit', compact('brand'));
}

    /**
     * Update the specified brand in storage.
     */
    public function update_brand(Request $request, $id) // Accept the ID of the brand as a parameter
{
    // Find the brand using the provided ID. If not found, throw a 404 error.
    $brand = Brand::findOrFail($id);

    // Validate incoming request data
    $request->validate([
        'name' => 'required|unique:brands,name,' . $brand->id, // Brand name is required and must be unique except for the current brand
        'slug' => 'required|unique:brands,slug,'.$request->id,
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size
    ]);

    // Update brand name and slug
    $brand->name = $request->name; // Set the name from the request
    $brand->slug = Str::slug($request->name); // Generate a slug from the brand name

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($brand->image && File::exists(public_path('uploads/brands/' . $brand->image))) {
            File::delete(public_path('uploads/brands/' . $brand->image)); // Remove the old image file
        }

        // Handle new image upload
        $file = $request->file('image'); // Get the uploaded file
        $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate a unique filename
        $file->move(public_path('uploads/brands'), $filename); // Move the uploaded file to the desired directory
        $brand->image = $filename; // Update the brand's image path
    }

    $brand->save(); // Save changes to the database

    // Flash a success message to indicate the brand was updated
    Session::flash('success', 'Brand updated successfully!');

    // Redirect the user back to the brand index page
    return redirect()->route('admin.brands');
}

    /**
     * Remove the specified brand from storage.
     */
    public function delete_brand($id) // Accept the ID of the brand as a parameter
    {
        // Find the brand using the provided ID. If not found, throw a 404 error.
        $brand = Brand::findOrFail($id);
    
        // Check if the brand has an image
        if ($brand->image && File::exists(public_path('uploads/brands/' . $brand->image))) {
            // If the image exists, delete the image file from the server
            File::delete(public_path('uploads/brands/' . $brand->image));
        }
    
        // Delete the brand from the database
        $brand->delete();
    
        // Flash a success message to the session to indicate the brand was deleted
        Session::flash('success', 'Brand deleted successfully!');
    
        // Redirect the user back to the brand index page
        return redirect()->route('admin.brands');
    }

}
