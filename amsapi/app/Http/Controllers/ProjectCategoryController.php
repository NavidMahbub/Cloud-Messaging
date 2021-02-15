<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\ProjectCategory;
use App\RoleUser;
use Sentinel;

use App\Http\Resources\ProjectCategory as ProjectCategoryResource;

class ProjectCategoryController extends Controller
{
    public function index(){
    	$project_category = ProjectCategory::all();
    	return ProjectCategoryResource::collection($project_category);
    }

    public function pagination(Request $request){

        $user_id = Auth()->user()->id;
        $role_id = RoleUser::where('user_id',$user_id)->first()->role_id;
        $role = Sentinel::findRoleById($role_id);
        $search_item = ($request->has('search_item'))?$request['search_item']:null;
        $project_category = '';
        if ($role->hasAccess(['category.view'])){

            $project_category  = ProjectCategory::when($search_item, function($q) use($search_item,$user_id){return $q->where('created_by',$user_id)->where('name','like',"%$search_item%");})
                ->when($user_id, function($q) use($user_id){return $q->where('created_by',$user_id);})
            ->paginate(10); 
        }
        if ($role->hasAccess(['category.viewall'])){
            $project_category  = ProjectCategory::when($search_item, function($q) use($search_item){return $q->where('name','like',"%$search_item%");})
            ->paginate(10); 
            
        }
               
        return ProjectCategoryResource::collection($project_category);
    }

    public function store(Request $request)
    {
        
        $category = $request->isMethod('put') ? ProjectCategory::findOrFail($request->category_id) : new ProjectCategory;
        $category -> status = $request->input('status');
        $category -> name = $request->input('name');


        $log_user = Auth()->user();
        $request->isMethod('put') ?  $category ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $category ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $category ->updated_by = $log_user->id : '' ;

        if($category->save()){
            return new ProjectCategoryResource($category);
        }
    }

    public function destroy($id)
    {
        $category = ProjectCategory::findOrFail($id);

        if($category->delete()){
        	return new ProjectCategoryResource($category);
        }
    }
}
