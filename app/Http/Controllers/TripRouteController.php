<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\TripRoute;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class TripRouteController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countriesList = Country::all();
        $tripRoutes = TripRoute::all();
        return view('trip_routes.index', compact('tripRoutes', 'countriesList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'points' => ['required', 'array'],
            'points.*.type' => ['required', 'string', 'in:Origin,Transit,Destination'],
            'points.*.country' => ['required', 'string', 'exists:countries,name']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }

        
        return $request;

        // Create a new TripRoute instance
        $tripRoute = new TripRoute([
            'type' => $request->input('type'),
            'legs' => $request->input('points'),
            // 'trip_price' => $request->input('trip_price'),
            'created_by' => auth()->user()->id,
        ]);

        // Save the instance to the database
        $tripRoute->save();

        return response()->json(['message' => __('Trip Route added successfully')], 200); 
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        // Get role details including permissions
        $tripRoute = TripRoute::find($id);
        return $tripRoute;

        if (!$tripRoute) {
            return response()->json(['error' => 'Trip Route not found'], 404);
        }

        return response()->json(['tripRoute' => $tripRoute]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripRoute $tripRoute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'points' => ['required', 'array'],
            'points.*.type' => ['required', 'string', 'in:Origin,Transit,Destination'],
            'points.*.country' => ['required', 'string', 'exists:countries,name']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }

        // Find the existing TripRoute by ID
        $tripRoute = TripRoute::findOrFail($id);

        // Update the attributes
        $tripRoute->type = $request->input('type');
        $tripRoute->legs = $request->input('points');
        // $tripRoute->trip_price = $request->input('trip_price');
        $tripRoute->updated_by = auth()->user()->id;

        // Save the updated instance to the database
        $tripRoute->save();

        return response()->json(['message' => __('Trip Route updated successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tripRoute = TripRoute::find($id);
        $tripRoute->deleted_by = auth()->user()->id;

        if ($tripRoute) {
            $tripRoute->delete();
            $tripRoute->save();

            return response()->json(['message' => __('Trip Route deleted successfully')]);
        }

        return response()->json(['message' => __('Trip Route not found')], 404);
    }

    public function get_trip_routes()
    {
        // Fetch trip routes with eager loading of 'legs' relationship and order by 'id' descending
        $tripRoutes = TripRoute::orderBy('id', 'DESC')->get();
    
        // Loop through each trip route and combine legs and types
        foreach ($tripRoutes as $tripRoute) {
            $legsCombined = '';
            foreach ($tripRoute->legs as $leg) {
                if (!empty($leg['country'])) {
                    $legsCombined .= ($legsCombined ? '. ' : '') . ' ' . __($leg['type']) . ' (' . __($leg['country']) . ') ';
                }
            }
            $tripRoute->legs_combined = $legsCombined;    
            $tripRoute->typeLocale = __($tripRoute->type); 
        }
    
        // Return the DataTables response
        return Datatables::of($tripRoutes)
            // Add the 'options' column based on permissions
            ->addColumn('options', function ($tripRoute) {
                $options = '<div class="text-xxl-center">';
                $options .= '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>';
                $options .= '<div class="dropdown-menu dropdown-menu-end m-0">';

                // Show button based on 'show trip route' permission
                if (auth()->user()->can('show trip route')) {
                    $options .= '<a href="javascript:;" class="dropdown-item showTripRoute" data-bs-target="#showTripRouteModal" data-bs-toggle="modal" data-bs-dismiss="modal">' .
                                '<i class="ti ti-eye me-2"></i>' . __('Show Route') . '</a>';
                }

                // Edit button based on 'edit trip route' permission
                if (auth()->user()->can('edit trip route')) {
                    $options .= '<a href="javascript:;" class="dropdown-item editTripRoute" data-bs-target="#editTripRouteModal" data-bs-toggle="modal" data-bs-dismiss="modal">' .
                                '<i class="ti ti-edit me-2"></i>' . __('Edit') . '</a>';
                }

                // Delete button based on 'delete trip route' permission
                if (auth()->user()->can('delete trip route')) {
                    $options .= '<a href="javascript:;" class="dropdown-item delete-record">' .
                                '<i class="ti ti-trash me-2"></i>' . __('Delete') . '</a>';
                }

                $options .= '</div></div>';

                return $options;
            })
            // Allow raw HTML for 'options' column
            ->rawColumns(['options'])
            ->make(true);
    }
}