@extends('admin.admin_master')

@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">
            <h4>Home About</h4>
            <a href="{{ route('add.about') }}"> <button class="btn btn-info">Add About</button></a>
            <br><br>


            <div class="col-md-12">
                <div class="card">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="card-header">
                        All About Data
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Home Title</th>
                                <th scope="col">Short Description</th>
                                <th scope="col">Long Description</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                            <tbody>
                                @php($i = 1)
                                @foreach ($homeabout as $about)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $about->title }}</td>
                                    <td>{{ $about->short_dis }}</td>
                                    <td>{{ $about->long_dis }}</td>
                                    <td>
                                        <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('about/delete/'.$about->id) }}"
                                            onclick="return confirm('Are You Sure to Delete?')"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection