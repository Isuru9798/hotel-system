@extends('layouts.app')

@section('content')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    +
</button>
<div class="card text-center">
    <h5 class="card-header">Rooms</h5>
    <!-- Button trigger modal -->

    <div class="card-body">
        <table class="table table-striped table-bordered table-hover" id="emp_list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Availability</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $key => $rm)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $rm->rm_number }}</td>
                    <td>{{ $rm->rm_type }}</td>
                    <td>{{ $rm->rm_availability }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                        <!-- <a class="btn btn-small btn-success" href="{{ URL::to('rooms/' . $rm->id) }}">Show</a> -->

                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('rooms/' . $rm->id . '/room.update')}}">Edit</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- start Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('room.add') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Room Number</label>
                        <input type="text" class="form-control" id="rm_number" name="rm_number" placeholder="Room Number">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Room Type</label>
                        <input type="text" class="form-control" id="rm_type" name="rm_type" placeholder="Room Type">
                    </div>
                    <input type="hidden" class="form-control" value="1" id="rm_availability" name="rm_availability" placeholder="Room Type">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
<!-- end Modal -->
@endsection