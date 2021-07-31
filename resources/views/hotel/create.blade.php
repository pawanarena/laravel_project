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
                    <h4>Add Information
                        <a href="{{ route('home') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('hotel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">County</label>
                                    <input type="text" name="county" class="form-control">
                                    @if($errors->has('county'))
                                        <p class="text-danger">{{ $errors->first('county') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Country</label>
                                    <input type="text" name="country" class="form-control">
                                    @if($errors->has('country'))
                                        <p class="text-danger">{{ $errors->first('country') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Town</label>
                                    <input type="text" name="town" class="form-control">
                                    @if($errors->has('town'))
                                        <p class="text-danger">{{ $errors->first('town') }}</p>
                                    @endif
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="">Displayable Address</label>
                                    <input type="text" name="displayable_address" class="form-control">
                                    @if($errors->has('displayable_address'))
                                        <p class="text-danger">{{ $errors->first('displayable_address') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="form-control">
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
                                        <option value="{{$i}}">{{$i}}</option>
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
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    @if($errors->has('number_of_bathrooms'))
                                        <p class="text-danger">{{ $errors->first('number_of_bathrooms') }}</p>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="">Price</label>
                                    <input type="text" name="price" class="form-control">
                                    @if($errors->has('price'))
                                        <p class="text-danger">{{ $errors->first('price') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Property Type</label>
                                    <select class="js-example-basic-single" name="property_type">
                                        <option value="type1">type1</option>
                                        <option value="type2">type2</option>
                                        <option value="type3">type3</option>
                                    </select>
                                    @if($errors->has('property_type'))
                                        <p class="text-danger">{{ $errors->first('property_type') }}</p>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="">Rent or Sale</label><br>
                                    <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="rent_or_sale" value="1">Rent
                                    </label>
                                    </div>
                                    <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="rent_or_sale" value="2">Sale
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
                            <textarea type="text" name="description" class="form-control"></textarea>
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