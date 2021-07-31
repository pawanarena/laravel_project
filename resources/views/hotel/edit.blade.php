@extends('layout.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Edid Information
                        <a href="{{ route('home') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('update.hotel',$hotel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">County</label>
                                    <input type="text" name="county" class="form-control" value="{{$hotel->county}}">
                                    @if($errors->has('county'))
                                        <p class="text-danger">{{ $errors->first('county') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Country</label>
                                    <input type="text" name="country" class="form-control" value="{{$hotel->country}}">
                                    @if($errors->has('country'))
                                        <p class="text-danger">{{ $errors->first('country') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Town</label>
                                    <input type="text" name="town" class="form-control" value="{{$hotel->town}}">
                                    @if($errors->has('town'))
                                        <p class="text-danger">{{ $errors->first('town') }}</p>
                                    @endif
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="">Displayable Address</label>
                                    <input type="text" name="displayable_address" class="form-control" value="{{$hotel->displayable_address}}">
                                    @if($errors->has('displayable_address'))
                                        <p class="text-danger">{{ $errors->first('displayable_address') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Image</label> 
                                    @if($hotel->image) 
                                        <a href="{{asset('uploads/images/'.$hotel->image)}}" target=_blank>view image</a>
                                    @endif
                                    <input type="file" name="image" class="form-control" value="{{$hotel->image}}">
                                    @if($errors->has('image'))
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Number of Bedrooms</label>
                                    <select class="js-example-basic-single" name="number_of_bedrooms">
                                        @for ($i = 1; $i < 10; $i++)
                                        <option value="{{$i}}" {{ ( $hotel->number_of_bedrooms==$i) ? 'selected' : '' }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    @if($errors->has('number_of_bedrooms'))
                                        <p class="text-danger">{{ $errors->first('number_of_bedrooms') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Number of Bathrooms</label>
                                    <select class="js-example-basic-single" name="number_of_bathrooms">
                                        @for ($i = 1; $i < 10; $i++)
                                        <option value="{{$i}}" {{ ( $hotel->number_of_bathrooms==$i) ? 'selected' : '' }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    @if($errors->has('number_of_bathrooms'))
                                        <p class="text-danger">{{ $errors->first('number_of_bathrooms') }}</p>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="">Price</label>
                                    <input type="text" name="price" class="form-control" value="{{$hotel->price}}">
                                    @if($errors->has('price'))
                                        <p class="text-danger">{{ $errors->first('price') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Property Type</label>
                                    <select class="js-example-basic-single" name="property_type">
                                        <option value="type1" {{ ( $hotel->property_type=="type1") ? 'selected' : '' }}>type1</option>
                                        <option value="type2" {{ ( $hotel->property_type=="type2") ? 'selected' : '' }}>type2</option>
                                        <option value="type3" {{ ( $hotel->property_type=="type3") ? 'selected' : '' }}>type3</option>
                                    </select>
                                    @if($errors->has('property_type'))
                                        <p class="text-danger">{{ $errors->first('property_type') }}</p>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="">Rent or Sale</label><br>
                                    <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="rent_or_sale" value="1" {{ ( $hotel->rent_or_sale=="1") ? 'checked' : '' }}>Rent
                                    </label>
                                    </div>
                                    <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="rent_or_sale" value="2" {{ ( $hotel->rent_or_sale=="2") ? 'checked' : '' }}>Sale
                                    </label>
                                    </div>
                                    @if($errors->has('rent_or_sale'))
                                        <p class="text-danger">{{ $errors->first('rent_or_sale') }}</p>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Description</label>
                            <textarea type="text" name="description" class="form-control">{{$hotel->description}}</textarea>
                            @if($errors->has('description'))
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection