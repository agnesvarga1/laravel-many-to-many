@extends('layouts.app')

@section('content')
<h2 class="text-center my-2">Project List</h2>
<div class="container">
    <a class="btn btn-success my-2 " href="{{route("dashboard.projects.create")}}">Add Project</a>
    <table class="table mx-auto">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Project Name</th>
            <th scope="col">Type</th>
            <th scope="col md">Description</th>
            <th scope="col">Slug</th>
            <th scope="col">Image</th>
            <th scope="col">Website URL</th>
            <th scope="col">Manage Projects</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $item )
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td><a href="{{route('dashboard.projects.show',$item->slug)}}">{{$item->project_name}}</a></td>
                <td>{{$item->type_id ? $item->type->name : ''}}</td>
                <td class="text-truncate" style="max-width: 200px;">{{$item->description}}</td>
                <td>{{$item->slug}}</td>
                <td>{{$item->image ? 'SI' : 'NO'}}</td>
                <td>{{$item->website}}</td>
                <td class="d-flex py-4 align-items-center gap-1"><a href={{route('dashboard.projects.edit',$item->slug)}} class="btn btn-primary fs-6 w-50 "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg></a>
                    <button type="button" class="btn btn-danger fs-6 w-50" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                          </svg></button>
                </td>

              </tr>
            @endforeach

        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Cancel</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5>Are you sure you want to delete this project?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="{{route('dashboard.projects.destroy',$item->slug)}}" method="POST">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-danger">Delete Project</button>
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
