<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::All();

        return view('pages.projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $techs= Technology::All();
        return view('pages.projects.create',compact('types','techs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
       // dd($request);
       $validData = $request->validated();
      // dd($validData);
       $slug = Project::generateSlug($request->project_name);

       $validData['slug'] = $slug;
      if($request->hasFile('image')){
        $path = Storage::disk('public')->put('project_images',$request->image);

        $validData['image']= $path;

      }
       // dd($validData);
     $newProject = Project::create($validData);
     if($request->has('techs')){
        $newProject->technologies()->attach($request->techs);
     }

      return redirect()->route('dashboard.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

       $techs = $project->technologies()->get();


        return view('pages.projects.show',compact('project','techs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $techs = Technology::All();
     return view('pages.projects.edit',compact('project','types','techs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $validData = $request->validated();

        $slug = Project::generateSlug($request->project_name);

        $validData['slug'] = $slug;

        if($request->hasFile('image')){
            if($project->image){
                Storage::delete($project->image);
              }
              $path = Storage::disk('public')->put('project_images',$request->image);

              $validData['image']= $path;

        }

       // dd($validData);

       $project->update($validData);
      // dd($project ,$request->techs);
        if( $request->has('techs') ){
            $project->technologies()->sync( $request->techs );
        }

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);
      if($project->image){
        Storage::delete($project->image);
      }
       $project->delete();
       return redirect()->route('dashboard.projects.index');
    }
}
