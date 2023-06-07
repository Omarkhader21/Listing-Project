<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/create',
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing,Request $request)
    {
        if($request->hasFile('images')){
            $request->validate([
                'images.*' => 'mimes:jpg,png,jpeg|max:5000'
            ] , [
                'images.*.mimes' => 'The file should be in one of the formats: jpg,png,jpeg',
                'images.*.max' => 'The file size should be 5000 bytes'
            ]);
            foreach ($request->images as $file){
                $path = $file->store('images','public');

                $listing->images()->save(new ListingImage([
                    'file_name' => $path
                ]));
            }
            return redirect()->back()->with('success','Images uploaded successfully!');
        }

        return  redirect()->back()->with('error','You have to select images');
    }

    public function destroy($listing,ListingImage $image)
    {
        Storage::disk('public')->delete($image->file_name);
        $image->delete();
        return redirect()->back()->with('success','Image deleted successfully!');
    }
}
