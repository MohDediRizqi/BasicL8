@extends('admin.admin_master')

@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">
            <h4>Admin Message</h4>
            <a href="{{ route('add.contact') }}"> <button class="btn btn-info">Add Contact</button></a>
            <br><br>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Message Data
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                            <tbody>
                                @php($i = 1)
                                @foreach ($messages as $msg)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $msg->name }}</td>
                                    <td>{{ $msg->email }}</td>
                                    <td>{{ $msg->subject }}</td>
                                    <td>{{ $msg->message }}</td>
                                    <td>
                                        <a href="{{ url('contact/delete/'.$msg->id) }}"
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
