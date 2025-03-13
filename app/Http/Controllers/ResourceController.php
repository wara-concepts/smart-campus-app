<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\Resource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $departments = department::pluck("department");
            $resources = Resource::pluck("name");
            return view('resources',compact('departments','resources'));
        } catch (\Throwable $th) {
            return view('resources',compact('th'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResourceRequest $request)
    {
        try {
            // Retrieve validated data from the request
            $validated = $request->validated();
    
            // Look up the department based on the provided department name
            $department = DB::table('departments')
                            ->where('department', $validated['departmentSelect'])
                            ->first();
    
            if (!$department) {
                return response()->json(['error' => 'Department not found'], 404);
            }
    
            // Insert the new resource and get its ID
            $resourceId = DB::table('resources')->insertGetId([
                'department_id' => $department->id,
                'name'          => $validated['resourceName'],
                'qty'           => $validated['resourceQuantity'],
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            $response = response()->json(['message' => 'Resource created successfully','id'=> $resourceId], 201);
            return $this->index();
    
        } catch (\Throwable $th) {
            return response()->json([
                'error'   => 'Something went wrong',
                'details' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        //
    }
}
