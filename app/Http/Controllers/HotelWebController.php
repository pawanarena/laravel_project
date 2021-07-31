<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

class HotelWebController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::query();
        if($request->name) {
            $query->where('county', 'LIKE', "%$request->name%")
                    ->orWhere('country', 'LIKE', "%$request->name%")
                    ->orWhere('town', 'LIKE', "%$request->name%");
        }
        if($request->number_of_bedrooms) {
            $query->where('number_of_bedrooms', $request->number_of_bedrooms);
        }
        if($request->price) {
            $query->where('price', $request->price);
        }
        if($request->property_type) {
            $query->where('property_type', $request->property_type);
        }
        if($request->rent_or_sale) {
            $query->where('rent_or_sale', $request->rent_or_sale);
        }
        
        $hotel = $query->paginate(10 );
        return view('hotel.index', compact('hotel'));
    }

    public function create()
    {
        return view('hotel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'county' => 'required',
            'country' => 'required',
            'town' => 'required',
            'description' => 'required',
            'displayable_address' => 'required',
            'image' => 'required|image:jpeg,png,jpg,gif,svg',
            'number_of_bedrooms' => 'required|numeric',
            'number_of_bathrooms' => 'required|numeric',
            'price' => 'required',
            'property_type' => 'required',
            'rent_or_sale' => 'required|numeric',
        ]);

        if($request->hasfile('image')){
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/thumbnail');
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);
            $destinationPath = public_path('uploads/images');
            $image->move($destinationPath, $image_name);
        }

        $hotel = new Hotel;
        $hotel->county = $request->county;
        $hotel->country = $request->country;
        $hotel->town = $request->town;
        $hotel->description = $request->description;
        $hotel->displayable_address = $request->displayable_address;
        $hotel->number_of_bedrooms = $request->number_of_bedrooms;
        $hotel->number_of_bathrooms = $request->number_of_bathrooms;
        $hotel->price = $request->price;
        $hotel->property_type = $request->property_type;
        $hotel->rent_or_sale = $request->rent_or_sale;
        $hotel->image = $image_name;
        $hotel->thumbnail = $image_name;
        $hotel->save();
        return redirect()->back()->with('status','Information Added Successfully');
    }

    public function edit($id)
    {
        $hotel = Hotel::find($id);
        return view('hotel.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'county' => 'required',
            'country' => 'required',
            'town' => 'required',
            'description' => 'required',
            'displayable_address' => 'required',
            'number_of_bedrooms' => 'required|numeric',
            'number_of_bathrooms' => 'required|numeric',
            'price' => 'required',
            'property_type' => 'required',
            'rent_or_sale' => 'required|numeric',
        ]);

        $hotel = Hotel::find($id);
        $hotel->county = $request->county;
        $hotel->country = $request->country;
        $hotel->town = $request->town;
        $hotel->description = $request->description;
        $hotel->displayable_address = $request->displayable_address;
        $hotel->number_of_bedrooms = $request->number_of_bedrooms;
        $hotel->number_of_bathrooms = $request->number_of_bathrooms;
        $hotel->price = $request->price;
        $hotel->property_type = $request->property_type;
        $hotel->rent_or_sale = $request->rent_or_sale;

        if($request->hasfile('image')){
            $destination_image = 'uploads/images/'.$hotel->image;
            $destination_thumbnail = 'uploads/thumbnail/'.$hotel->thumbnail;
            if(File::exists($destination_image))
            {
                File::delete($destination_image);
            }
            if(File::exists($destination_thumbnail))
            {
                File::delete($destination_thumbnail);
            }

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/thumbnail');
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);
            $destinationPath = public_path('uploads/images');
            $image->move($destinationPath, $image_name);
            $hotel->image = $image_name;
            $hotel->thumbnail = $image_name;
        }

        $hotel->update();
        return redirect()->back()->with('status','Information Updated Successfully');
    }

    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        $destination = 'storage/images/'.$hotel->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $hotel->delete();
        return redirect()->back()->with('status','Information Deleted Successfully');
    }
}