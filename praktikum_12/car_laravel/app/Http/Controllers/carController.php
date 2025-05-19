<?php
 
namespace App\Http\Controllers;
 
use App\Models\car;
use App\Models\Merk;
use Illuminate\Http\Request;
 
class carController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cars = car::with('merk')->get();
        return view('car.index', compact('cars'));
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $merks = Merk::all(); return view('car.create', compact('merks'));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'merk_id' => 'required|exists:merks,id',
            'model' => 'required',
            'color' => 'required',
            'year' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('car_images', 'public');
        }
    
        car::create($data);
    
        return redirect()->route('car.index')->with('message', 'Car added successfully!');
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}