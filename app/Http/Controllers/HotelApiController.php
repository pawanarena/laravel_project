<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\HotelCollection as HotelCollection;
use App\Http\Resources\HotelResource as HotelResource;
use App\Models\Hotel;
use Image;

class HotelApiController extends Controller
{
    public function list(){
        return new HotelCollection(Hotel::paginate(30));
    }

    public function store(Request $request){
        // Validate the inputs
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
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
            $hotel = new Hotel([
                "county" => $request->county,
                "country" => $request->country,
                "town" => $request->town,
                "description" => $request->description,
                "displayable_address" => $request->displayable_address,
                "image" => $image_name ?? '',
                "thumbnail" => $image_name ?? '',
                "number_of_bedrooms" => $request->number_of_bedrooms,
                "number_of_bathrooms" => $request->number_of_bathrooms,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "price" => $request->price,
                "property_type" => $request->property_type,
                "rent_or_sale" => $request->rent_or_sale,
            ]);
            $hotel->save(); // Finally, save the record.
            return response()->json([
                'message' => 'Successfully created user!',
            ], 201);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
