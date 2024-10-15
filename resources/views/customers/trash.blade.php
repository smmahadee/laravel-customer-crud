<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>
@extends('layout.index')

@section('contents')
    <div class="row justify-content-center mt-5">
        <div class="px-5">
            <h3>Customers</h3>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('customers.index') }}" class="btn" style="background-color: #4643d3; color: white;"><i
                                    class="fas fa-chevron-left"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('customers.trash') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="Search anything..."
                                        aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="submit"
                                        id="button-addon2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">

                            <div class="input-group mb-3">
                               <form action="{{ route('customers.trash') }}" method="GET" class='order-form'>      <select class="form-select" name="order" id="" onchange="$('.order-form').submit()">
                                    <option @selected(request()->order == 'desc') value="desc">Newest to Old</option>
                                    <option @selected(request()->order == 'asc') value="asc">Old to Newest</option>
                                </select>
                            </form>
                          
                            </div>
                        </div>
                      
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="border: 1px solid #dddddd">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">BAN</th>
                                <th scope="col">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $customer->first_name }}</td>
                                    <td>{{ $customer->last_name }}</td>
                                    <td>{{ $customer->date_of_birth }}</td>
                                    <td>{{ $customer->phone_number }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->card_number }}</td>
                                    <td>
                                        <a href="{{ route('customers.restore', $customer->id) }}" style="color: #2c2c2c;" class="ms-1 me-1">Restore</a>
                                        <a href="javascript:;" onclick="if(confirm('Are you sure ?')) $('.forceDelete-form-{{ $customer->id }}').submit()" style="color: #2c2c2c;" class="ms-1 me-1">Delete</a>

                                        <form class="forceDelete-form-{{ $customer->id }}" action="{{ route('customers.force.destroy', $customer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                        
                                    </td>
                                   
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
