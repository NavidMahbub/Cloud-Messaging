<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Sentinel;
use App\RoleUser;
use App\Http\Resources\Project as ProjectResource;

class ProjectController extends Controller
{
    public function index(Request $request){
        $user_id = Auth()->user()->id;
        $role_id = RoleUser::where('user_id',$user_id)->first()->role_id;
        $role = Sentinel::findRoleById($role_id);
        $search_item = ($request->has('search_item'))?$request['search_item']:null;
        $project = '';
        if ($role->hasAccess(['project.view'])){
            $project = Project::when($search_item , function($q) use($search_item,$user_id){return $q->where('created_by',$user_id)->where('name','like',"%$search_item%");})
                ->when($user_id , function($q) use($user_id){return $q->where('created_by',$user_id);})
               ->paginate(10); 
        }
        if ($role->hasAccess(['project.viewall'])){
           $project = Project::when($search_item , function($q) use($search_item){return $q->where('name','like',"%$search_item%");})
           ->paginate(10); 
        }
    	return ProjectResource::collection($project);
    }

    public function allProject(){
        $project = Project::all();
        return ProjectResource::collection($project);
    }

    public function store(Request $request)
    {

        $project = $request->isMethod('put') ? Project::findOrFail($request->project_id) : new Project;
        $project -> project_category_id = $request->input('project_category_id');
        $project -> status = $request->input('status');
        $project -> name = $request->input('name');
        $project -> type = $request->input('type');
        $project -> block_no = $request->input('block_no');
        $project -> road_no = $request->input('road_no');
        $project -> plot_size = $request->input('plot_size');
        
        $project -> sales_price = $request->input('sales_price');
        $project -> purchase_price = $request->input('purchase_price');
        $project -> location = $request->input('location');

        // if($request->not_edit_image == 10){
        //     $project -> image = $request->image;
        // }
        if($request->not_edit_image == 11){
            $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';

            $fileName = str_random().'.'.$extension;
            $path = public_path().'/images/'.$fileName;
            file_put_contents($path, $decoded);
            $project -> image = url('/').'/images/'.$fileName;
        }

        $log_user = Auth()->user();
        $request->isMethod('put') ?  $project ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $project ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $project ->updated_by = $log_user->id : '' ;
        

        if($project->save()){
            return new ProjectResource($project);
        }
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if($project->delete()){
        	return new ProjectResource($project);
        }
    }
}
