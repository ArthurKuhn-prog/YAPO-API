<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = ProjectResource::collection(Project::paginate());
        if($projects->count() > 0){
            $data = [
                'status' => 200,
                'projects' => $projects,
            ];

            return response()->json($data, 200);
        } else {
            return response->json([
                'status' => 404,
                'message' => 'No Projects Found'
            ], 440);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'description' => 'sometimes|nullable|string|max:1500',
            'thumbnail' => 'sometimes|nullable',
            'content' => 'sometimes|nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            $project = Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'thumbnail' => $request->thumbnail,
                'content' => $request->content,
            ]);

            if($project){
                return response()->json([
                    'status' => 200,
                    'message' => 'Project created successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projectContent = Project::where('id', $id)->get(['content']);
        if($projectContent){
            return response()->json([
                'status'=> 200,
                'content' => $projectContent
            ],200);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'No Project Content Found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|nullable|string|max:200',
            'description' => 'sometimes|nullable|string|max:1500',
            'thumbnail' => 'sometimes|nullable',
            'content' => 'sometimes|nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            $project = Project::find($id);

            if($project){
                $project = Project::where('id', $id)->update($request->all());

                return response()->json([
                    'status' => 200,
                    'message' => 'Project updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);

        if($project){
            $project->delete();
            return response()->json([
                'status'=> 200,
                'message' => 'Project deleted successfully'
            ],200);
        } else {
            return response()->json([
                'status'=> 404,
                'message' => 'No Project Found'
            ],404);
        }
    }
}
