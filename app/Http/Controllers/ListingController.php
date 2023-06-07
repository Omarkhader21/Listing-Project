<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        return inertia('Listing/Index', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()
                ->filter($filters)
                ->withCount(['images'])
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function show(Listing $listing)
    {
//        if (\Auth::user()->cannot('view',$listing)){
//           abort(403);
//        }
//        $this->authorize('view',$listing);

        $listing->load(['images']);

        return inertia('Listing/Show', [
            'listing' => $listing,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
}
