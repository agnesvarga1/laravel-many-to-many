@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="text-center">{{$project->project_name}}</h1>
    <h3>{{$project->type ? $project->type->name . ' project ': 'Unknown project type'}}</h3>

  <span>Technologies:</span>

  @foreach ($techs as $item )
     <span> {{$item->name}}, </span>
  @endforeach




    <div class="row justify-content-center">
        @if ($project->image)
        <img class="w-50 d-block my-3 border border-success" src="{{asset('storage/'.$project->image)}}" alt="project's image">
      @endif
      <p class="text-center">
          {{$project->description}}
      </p>
    </div>

</div>

@endsection
