@extends('layout.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Laravel CRUD
                        <a href="{{ route('hotel') }}" class="btn btn-primary float-end">Add Student</a>
                    </h4>
                </div>
                <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ isset($_GET['name'])?$_GET['name']:'' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="number_of_bedrooms" class="form-control" id="number_of_bedrooms" placeholder="Number of Bedrooms" value="{{ isset($_GET['number_of_bedrooms'])?$_GET['number_of_bedrooms']:'' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="price" class="form-control" id="price" placeholder="Price" value="{{ isset($_GET['price'])?$_GET['price']:'' }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="property_type" class="form-control" id="property_type" placeholder="Property Type" value="{{ isset($_GET['property_type'])?$_GET['property_type']:'' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <select class="js-example-basic-single" name="rent_or_sale">
                                <option value="">select</option>
                                <option value="1">rent</option>
                                <option value="2">sale</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('home')}}" class="btn btn-danger">Reset</a>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>county</th>
                                <th>country</th>
                                <th>Town</th>
                                <th>Description</th>
                                <th>Displayable Address</th>
                                <th>Number of Bedrooms</th>
                                <th>Number of Bathrooms</th>
                                <th>Property Type</th>
                                <th>Price</th>
                                <th>Rent or Sale</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotel as $item)
                            <tr>
                                <td>{{ $loop->iteration }}  </td>
                                <td>{{ $item->county }}</td>
                                <td>{{ $item->country }}</td>
                                <td>{{ $item->town }}</td>
                                <td>{{ Illuminate\Support\Str::limit($item->description, 20) }}</td>
                                <td>{{ $item->displayable_address}}</td>
                                <td>{{ $item->number_of_bedrooms}}</td>
                                <td>{{ $item->number_of_bathrooms}}</td>
                                <td>{{ $item->property_type}}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{ $item->rent_or_sale}}</td>
                                <td>
                                    @if($item->image)
                                    <img src="{{ asset('uploads/images/'.$item->image) }}" width="70px" height="70px" alt="Image">
                                    @else
                                    No Image found
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('edit.hotel',$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    <!-- {{-- <a href="{{ url('delete-student/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a> --}} -->
                                    <form action="{{ route('delete.hotel',$item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    {{$hotel->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection