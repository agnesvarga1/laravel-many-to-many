@extends('layouts.app')

@section('content')
<h2 class="text-center">Modify Project</h2>
<div class="container">

    <form action="{{route("dashboard.projects.update",$project->slug)}}" method="POST" enctype="multipart/form-data">
        @csrf
               @method('PUT')
              <label for="project_name">Project Name</label>
              <input
               value="{{old('project_name') ?? $project->project_name }}"
               id="project_name"
               type="text"
               class="form-control mb-3 @error("project_name") is-invali @enderror"
               name="project_name"
             >

                @error('project_name')
               <div class="alert alert-danger">{{ $message }}</div>
               @enderror

              <label for="description">Project's description</label>
              <textarea class="form-control mb-3 @error("description") is-invalid  @enderror" name="description" id="description" rows="3">{{old('description')?? $project->description}}</textarea>
                @error('description')
               <div class="alert alert-danger">{{ $message }}</div>
               @enderror

               <label for="type_id">Project Type</label>
               <select id="type_id" name="type_id" class="form-select @error("type_id") is-invalid  @enderror" aria-label="Default select example">
                   <option selected>Open this select menu</option>

                   @foreach ($types as $item )
                   <option value="{{$item->id}}" {{$item->id == old('type_id',$project->type ? $project->type->id : '') ? 'selected':''}}>{{$item->name}}</option>
                   @endforeach

               </select>
               @error('type_id')
               <div class="alert alert-danger">{{ $message }}</div>
               @enderror
               <div class="my-2">
                <p>Used Technologies</p>

                @foreach ($techs as $item )
                <div class="form-check">

                    <input
                    class="form-check-input"
                    type="checkbox"
                    value="{{$item->id}}"
                    id="flexCheckDefault"
                    name="techs[]"
                    {{ $project->technologies->contains( $item->id ) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                      {{$item->name}}
                    </label>


                  </div>
                  @endforeach

            </div>
               <div class="mb-3">
                <label for="formFile" class="form-label">Add an image</label>
                <input value="{{old('image')}}" class="form-control  @error("image") is-invalid  @enderror" type="file" id="formFile" name="image">
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

              </div>
              <label for="website">Website URL</label>
              <input required id="website" type="text" class="form-control mb-3 @error("website") is-invalid  @enderror" name="website" value={{old('website') ?? $project->website}} >
              @error('website')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <button type="submit" class="btn bg-success text-light">Save</button>
        </form>
</div>

@endsection
