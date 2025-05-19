@extends('layout.app')
 
@section('title', 'car List')
 
@section('content')
    <a href="{{ route('car.create') }}" class="btn btn-primary mb-3">Add New car</a>
 
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
 
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Merk</th><th>Model</th><th>Color</th><th>Year</th><th>Price</th><th>Image</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->merk->name }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->color }}</td>
                <td>{{ $car->year }}</td>
                <td>Rp {{ number_format($car->price, 0, ',', '.') }}</td>
                <td>
                    <img src="{{ asset('storage/'.$car->image) }}" width="100" alt="car Image">
                </td>
                <td>
                    <a href="" class="btn btn-info btn-sm">View</a>
                    <a href="" class="btn btn-warning btn-sm">Edit</a>
                    <form action="" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection