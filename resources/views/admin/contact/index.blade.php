@extends('admin.admin_master')

@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">
            <h4>Contact Page</h4>
            <a href="{{ route('add.contact') }}"> <button class="btn btn-info">Add Contact</button></a>
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
                        All Contact Data
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Address</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Phone</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                            <tbody>
                                @php($i = 1)
                                @foreach ($contacts as $contact)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $contact->address }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>
                                        <a href="{{ url('contact/edit/'.$contact->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('contact/delete/'.$contact->id) }}"
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
