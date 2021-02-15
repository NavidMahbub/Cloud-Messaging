<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Sentinel;
use DB;
use App\RoleUser;
use App\Http\Resources\Role as RoleResource;
use Illuminate\Database\QueryException;

class RoleController extends Controller
{
    
    
    public function index()
    {   
        $role = DB::table('roles')->whereNotIn('id', [1,2])->get();
        // $role = DB::table('roles')->get();
        return RoleResource::collection($role);
    }

    public function index2()
    {   
        $user_id = Auth()->user()->id;
        $role_id = RoleUser::where('user_id',$user_id)->first()->role_id;
        $role = Sentinel::findRoleById($role_id);
        return new RoleResource($role);
    }

    public function index3()
    {   
        $role = DB::table('roles')->whereNotIn('id', [1,2])->get();
        // $role = DB::table('roles')->get();
        return RoleResource::collection($role);
    }

    public function store(Request $request)
    {
        
        try{
            $name = $request->name;
            $slug = strtolower($request->name);
            $role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => $name,
                'slug' => $slug,
            ]);
            
            $role->permissions = [
                'contact.view'   => $request->contact_view,   
                'contact.viewall'   => $request->contact_view_all,   
                'contact.create' => $request->contact_create,
                'contact.update' => $request->contact_update,
                'contact.updateall' => $request->contact_update_all,
                'contact.delete' => $request->contact_delete,
                'contact.deleteall' => $request->contact_delete_all,

                'category.view'   => $request->project_category_view,
                'category.viewall'   => $request->project_category_view_all,
                'category.create' => $request->project_category_create,
                'category.update' => $request->project_category_update,
                'category.updateall' => $request->project_category_update_all,
                'category.delete' => $request->project_category_delete,
                'category.deleteall' => $request->project_category_delete_all,

                'project.view'   => $request->project_view,
                'project.viewall'   => $request->project_view_all,
                'project.create' => $request->project_create,
                'project.update' => $request->project_update,
                'project.updateall' => $request->project_update_all,
                'project.delete' => $request->project_delete,
                'project.deleteall' => $request->project_delete_all,

                'purpose.view'   => $request->purpose_view,
                'purpose.viewall'   => $request->purpose_view_all,
                'purpose.create' => $request->purpose_create,
                'purpose.update' => $request->purpose_update,
                'purpose.updateall' => $request->purpose_update_all,
                'purpose.delete' => $request->purpose_delete,
                'purpose.deleteall' => $request->purpose_delete_all,

                'income.view'   => $request->income_view,
                'income.viewall'   => $request->income_view_all,
                'income.create' => $request->income_create,
                'income.update' => $request->income_update,
                'income.updateall' => $request->income_update_all,
                'income.delete' => $request->income_delete,
                'income.deleteall' => $request->income_delete_all,

                'expense.view'   => $request->expense_view,
                'expense.viewall'   => $request->expense_view_all,
                'expense.create' => $request->expense_create,
                'expense.update' => $request->expense_update,
                'expense.updateall' => $request->expense_update_all,
                'expense.delete' => $request->expense_delete,
                'expense.deleteall' => $request->expense_delete_all,

                'invoice.view'   => $request->invoice_view,
                'invoice.viewall'   => $request->invoice_view_all,
                'invoice.create' => $request->invoice_create,
                'invoice.update' => $request->invoice_update,
                'invoice.updateall' => $request->invoice_update_all,
                'invoice.delete' => $request->invoice_delete,
                'invoice.deleteall' => $request->invoice_delete_all,

                'payment.view'   => $request->payment_view,
                'payment.viewall'   => $request->payment_view_all,
                'payment.create' => $request->payment_create,
                'payment.update' => $request->payment_update,
                'payment.updateall' => $request->payment_update_all,
                'payment.delete' => $request->payment_delete,
                'payment.deleteall' => $request->payment_delete_all,

                'recuiting.view'   => $request->recuiting_view,
                'recuiting.viewall'   => $request->recuiting_view_all,
                'recuiting.create' => $request->recuiting_create,
                'recuiting.update' => $request->recuiting_update,
                'recuiting.updateall' => $request->recuiting_update_all,
                'recuiting.delete' => $request->recuiting_delete,
                'recuiting.deleteall' => $request->recuiting_delete_all,

                'medical.view'   => $request->medical_view,
                'medical.viewall'   => $request->medical_view_all,
                'medical.create' => $request->medical_create,
                'medical.update' => $request->medical_update,
                'medical.updateall' => $request->medical_update_all,
                'medical.delete' => $request->medical_delete,
                'medical.deleteall' => $request->medical_delete_all,

                'musaned.view'   => $request->musaned_view,
                'musaned.viewall'   => $request->musaned_view_all,
                'musaned.create' => $request->musaned_create,
                'musaned.update' => $request->musaned_update,
                'musaned.updateall' => $request->musaned_update_all,
                'musaned.delete' => $request->musaned_delete,
                'musaned.deleteall' => $request->musaned_delete_all,

                'okala.view'   => $request->okala_view,
                'okala.viewall'   => $request->okala_view_all,
                'okala.create' => $request->okala_create,
                'okala.update' => $request->okala_update,
                'okala.updateall' => $request->okala_update_all,
                'okala.delete' => $request->okala_delete,
                'okala.deleteall' => $request->okala_delete_all,

                'mofa.view'   => $request->mofa_view,
                'mofa.viewall'   => $request->mofa_view_all,
                'mofa.create' => $request->mofa_create,
                'mofa.update' => $request->mofa_update,
                'mofa.updateall' => $request->mofa_update_all,
                'mofa.delete' => $request->mofa_delete,
                'mofa.deleteall' => $request->mofa_delete_all,

                'stamping.view'   => $request->stamping_view,
                'stamping.viewall'   => $request->stamping_view_all,
                'stamping.create' => $request->stamping_create,
                'stamping.update' => $request->stamping_update,
                'stamping.updateall' => $request->stamping_update_all,
                'stamping.delete' => $request->stamping_delete,
                'stamping.deleteall' => $request->stamping_delete_all,

                'finger.view'   => $request->finger_view,
                'finger.viewall'   => $request->finger_view_all,
                'finger.create' => $request->finger_create,
                'finger.update' => $request->finger_update,
                'finger.updateall' => $request->finger_update_all,
                'finger.delete' => $request->finger_delete,
                'finger.deleteall' => $request->finger_delete_all,
                
                'training.view'   => $request->training_view,
                'training.viewall'   => $request->training_view_all,
                'training.create' => $request->training_create,
                'training.update' => $request->training_update,
                'training.updateall' => $request->training_update_all,
                'training.delete' => $request->training_delete,
                'training.deleteall' => $request->training_delete_all,

                'manpower.view'   => $request->manpower_view,
                'manpower.viewall'   => $request->manpower_view_all,
                'manpower.create' => $request->manpower_create,
                'manpower.update' => $request->manpower_update,
                'manpower.updateall' => $request->manpower_update_all,
                'manpower.delete' => $request->manpower_delete,
                'manpower.deleteall' => $request->manpower_delete_all,

                'flight.view'   => $request->flight_view,
                'flight.viewall'   => $request->flight_view_all,
                'flight.create' => $request->flight_create,
                'flight.update' => $request->flight_update,
                'flight.updateall' => $request->flight_update_all,
                'flight.delete' => $request->flight_delete,
                'flight.deleteall' => $request->flight_delete_all,

                'role.view'   => $request->role_view,
                'role.viewall'   => $request->role_view_all,
                'role.create' => $request->role_create,
                'role.update' => $request->role_update,
                'role.updateall' => $request->role_update_all,
                'role.delete' => $request->role_delete,
                'role.deleteall' => $request->role_delete_all,
                
                'completed.view'   => $request->completed_view,
                'completed.viewall'   => $request->completed_view_all,
                'completed.create' => $request->completed_create,
                'completed.update' => $request->completed_update,
                'completed.updateall' => $request->completed_update_all,
                'completed.delete' => $request->completed_delete,
                'completed.deleteall' => $request->completed_delete_all,
                
                'account.view'   => $request->account_view,
                'account.viewall'   => $request->account_view_all,
                'account.create' => $request->account_create,
                'account.update' => $request->account_update,
                'account.updateall' => $request->account_update_all,
                'account.delete' => $request->account_delete,
                'account.deleteall' => $request->account_delete_all,
            ];
            $role->permissions2 = json_encode([
                'contact_view'   => $request->contact_view,   
                'contact_viewall'   => $request->contact_view_all,   
                'contact_create' => $request->contact_create,
                'contact_update' => $request->contact_update,
                'contact_updateall' => $request->contact_update_all,
                'contact_delete' => $request->contact_delete,
                'contact_deleteall' => $request->contact_delete_all,

                'category_view'   => $request->project_category_view,
                'category_viewall'   => $request->project_category_view_all,
                'category_create' => $request->project_category_create,
                'category_update' => $request->project_category_update,
                'category_updateall' => $request->project_category_update_all,
                'category_delete' => $request->project_category_delete,
                'category_deleteall' => $request->project_category_delete_all,

                'project_view'   => $request->project_view,
                'project_viewall'   => $request->project_view_all,
                'project_create' => $request->project_create,
                'project_update' => $request->project_update,
                'project_updateall' => $request->project_update_all,
                'project_delete' => $request->project_delete,
                'project_deleteall' => $request->project_delete_all,

                'purpose_view'   => $request->purpose_view,
                'purpose_viewall'   => $request->purpose_view_all,
                'purpose_create' => $request->purpose_create,
                'purpose_update' => $request->purpose_update,
                'purpose_updateall' => $request->purpose_update_all,
                'purpose_delete' => $request->purpose_delete,
                'purpose_deleteall' => $request->purpose_delete_all,

                'income_view'   => $request->income_view,
                'income_viewall'   => $request->income_view_all,
                'income_create' => $request->income_create,
                'income_update' => $request->income_update,
                'income_updateall' => $request->income_update_all,
                'income_delete' => $request->income_delete,
                'income_deleteall' => $request->income_delete_all,

                'expense_view'   => $request->expense_view,
                'expense_viewall'   => $request->expense_view_all,
                'expense_create' => $request->expense_create,
                'expense_update' => $request->expense_update,
                'expense_updateall' => $request->expense_update_all,
                'expense_delete' => $request->expense_delete,
                'expense_deleteall' => $request->expense_delete_all,

                'invoice_view'   => $request->invoice_view,
                'invoice_viewall'   => $request->invoice_view_all,
                'invoice_create' => $request->invoice_create,
                'invoice_update' => $request->invoice_update,
                'invoice_updateall' => $request->invoice_update_all,
                'invoice_delete' => $request->invoice_delete,
                'invoice_deleteall' => $request->invoice_delete_all,

                'payment_view'   => $request->payment_view,
                'payment_viewall'   => $request->payment_view_all,
                'payment_create' => $request->payment_create,
                'payment_update' => $request->payment_update,
                'payment_updateall' => $request->payment_update_all,
                'payment_delete' => $request->payment_delete,
                'payment_deleteall' => $request->payment_delete_all,

                'recuiting_view'   => $request->recuiting_view,
                'recuiting_viewall'   => $request->recuiting_view_all,
                'recuiting_create' => $request->recuiting_create,
                'recuiting_update' => $request->recuiting_update,
                'recuiting_updateall' => $request->recuiting_update_all,
                'recuiting_delete' => $request->recuiting_delete,
                'recuiting_deleteall' => $request->recuiting_delete_all,

                'medical_view'   => $request->medical_view,
                'medical_viewall'   => $request->medical_view_all,
                'medical_create' => $request->medical_create,
                'medical_update' => $request->medical_update,
                'medical_updateall' => $request->medical_update_all,
                'medical_delete' => $request->medical_delete,
                'medical_deleteall' => $request->medical_delete_all,

                'musaned_view'   => $request->musaned_view,
                'musaned_viewall'   => $request->musaned_view_all,
                'musaned_create' => $request->musaned_create,
                'musaned_update' => $request->musaned_update,
                'musaned_updateall' => $request->musaned_update_all,
                'musaned_delete' => $request->musaned_delete,
                'musaned_deleteall' => $request->musaned_delete_all,

                'okala_view'   => $request->okala_view,
                'okala_viewall'   => $request->okala_view_all,
                'okala_create' => $request->okala_create,
                'okala_update' => $request->okala_update,
                'okala_updateall' => $request->okala_update_all,
                'okala_delete' => $request->okala_delete,
                'okala_deleteall' => $request->okala_delete_all,

                'mofa_view'   => $request->mofa_view,
                'mofa_viewall'   => $request->mofa_view_all,
                'mofa_create' => $request->mofa_create,
                'mofa_update' => $request->mofa_update,
                'mofa_updateall' => $request->mofa_update_all,
                'mofa_delete' => $request->mofa_delete,
                'mofa_deleteall' => $request->mofa_delete_all,

                'stamping_view'   => $request->stamping_view,
                'stamping_viewall'   => $request->stamping_view_all,
                'stamping_create' => $request->stamping_create,
                'stamping_update' => $request->stamping_update,
                'stamping_updateall' => $request->stamping_update_all,
                'stamping_delete' => $request->stamping_delete,
                'stamping_deleteall' => $request->stamping_delete_all,

                'finger_view'   => $request->finger_view,
                'finger_viewall'   => $request->finger_view_all,
                'finger_create' => $request->finger_create,
                'finger_update' => $request->finger_update,
                'finger_updateall' => $request->finger_update_all,
                'finger_delete' => $request->finger_delete,
                'finger_deleteall' => $request->finger_delete_all,
                
                'training_view'   => $request->training_view,
                'training_viewall'   => $request->training_view_all,
                'training_create' => $request->training_create,
                'training_update' => $request->training_update,
                'training_updateall' => $request->training_update_all,
                'training_delete' => $request->training_delete,
                'training_deleteall' => $request->training_delete_all,

                'manpower_view'   => $request->manpower_view,
                'manpower_viewall'   => $request->manpower_view_all,
                'manpower_create' => $request->manpower_create,
                'manpower_update' => $request->manpower_update,
                'manpower_updateall' => $request->manpower_update_all,
                'manpower_delete' => $request->manpower_delete,
                'manpower_deleteall' => $request->manpower_delete_all,

                'flight_view'   => $request->flight_view,
                'flight_viewall'   => $request->flight_view_all,
                'flight_create' => $request->flight_create,
                'flight_update' => $request->flight_update,
                'flight_updateall' => $request->flight_update_all,
                'flight_delete' => $request->flight_delete,
                'flight_deleteall' => $request->flight_delete_all,


                'role_view'   => $request->role_view,
                'role_viewall'   => $request->role_view_all,
                'role_create' => $request->role_create,
                'role_update' => $request->role_update,
                'role_updateall' => $request->role_update_all,
                'role_delete' => $request->role_delete,
                'role_deleteall' => $request->role_delete_all,
                
                'completed_view'   => $request->completed_view,
                'completed_viewall'   => $request->completed_view_all,
                'completed_create' => $request->completed_create,
                'completed_update' => $request->completed_update,
                'completed_updateall' => $request->completed_update_all,
                'completed_delete' => $request->completed_delete,
                'completed_deleteall' => $request->completed_delete_all,
                
                'account_view'   => $request->account_view,
                'account_viewall'   => $request->account_view_all,
                'account_create' => $request->account_create,
                'account_update' => $request->account_update,
                'account_updateall' => $request->account_update_all,
                'account_delete' => $request->account_delete,
                'account_deleteall' => $request->account_delete_all,
            ]);

            $log_user = Auth()->user();
            $role->created_by = $log_user->id;
            $role->updated_by = $log_user->id;

            if($role->save()){
                return new RoleResource($role);
            }
        }
        catch (QueryException $e) {
            return response()->json(['error'=>'Role name must be unique'],400);
        }
    }

    public function update(Request $request)
    {

        try{
            
            $name = $request->input('name');
            $slug = strtolower($request->input('name'));
            $role = Sentinel::findRoleById($request->role_id);
            $role->name = $name;
            $role->slug = $slug;
            $role->permissions = [
                'contact.view'   => $request->contact_view,   
                'contact.viewall'   => $request->contact_view_all,   
                'contact.create' => $request->contact_create,
                'contact.update' => $request->contact_update,
                'contact.updateall' => $request->contact_update_all,
                'contact.delete' => $request->contact_delete,
                'contact.deleteall' => $request->contact_delete_all,

                'category.view'   => $request->project_category_view,
                'category.viewall'   => $request->project_category_view_all,
                'category.create' => $request->project_category_create,
                'category.update' => $request->project_category_update,
                'category.updateall' => $request->project_category_update_all,
                'category.delete' => $request->project_category_delete,
                'category.deleteall' => $request->project_category_delete_all,

                'project.view'   => $request->project_view,
                'project.viewall'   => $request->project_view_all,
                'project.create' => $request->project_create,
                'project.update' => $request->project_update,
                'project.updateall' => $request->project_update_all,
                'project.delete' => $request->project_delete,
                'project.deleteall' => $request->project_delete_all,

                'purpose.view'   => $request->purpose_view,
                'purpose.viewall'   => $request->purpose_view_all,
                'purpose.create' => $request->purpose_create,
                'purpose.update' => $request->purpose_update,
                'purpose.updateall' => $request->purpose_update_all,
                'purpose.delete' => $request->purpose_delete,
                'purpose.deleteall' => $request->purpose_delete_all,

                'income.view'   => $request->income_view,
                'income.viewall'   => $request->income_view_all,
                'income.create' => $request->income_create,
                'income.update' => $request->income_update,
                'income.updateall' => $request->income_update_all,
                'income.delete' => $request->income_delete,
                'income.deleteall' => $request->income_delete_all,

                'expense.view'   => $request->expense_view,
                'expense.viewall'   => $request->expense_view_all,
                'expense.create' => $request->expense_create,
                'expense.update' => $request->expense_update,
                'expense.updateall' => $request->expense_update_all,
                'expense.delete' => $request->expense_delete,
                'expense.deleteall' => $request->expense_delete_all,

                'invoice.view'   => $request->invoice_view,
                'invoice.viewall'   => $request->invoice_view_all,
                'invoice.create' => $request->invoice_create,
                'invoice.update' => $request->invoice_update,
                'invoice.updateall' => $request->invoice_update_all,
                'invoice.delete' => $request->invoice_delete,
                'invoice.deleteall' => $request->invoice_delete_all,

                'payment.view'   => $request->payment_view,
                'payment.viewall'   => $request->payment_view_all,
                'payment.create' => $request->payment_create,
                'payment.update' => $request->payment_update,
                'payment.updateall' => $request->payment_update_all,
                'payment.delete' => $request->payment_delete,
                'payment.deleteall' => $request->payment_delete_all,

                'recuiting.view'   => $request->recuiting_view,
                'recuiting.viewall'   => $request->recuiting_view_all,
                'recuiting.create' => $request->recuiting_create,
                'recuiting.update' => $request->recuiting_update,
                'recuiting.updateall' => $request->recuiting_update_all,
                'recuiting.delete' => $request->recuiting_delete,
                'recuiting.deleteall' => $request->recuiting_delete_all,

                'medical.view'   => $request->medical_view,
                'medical.viewall'   => $request->medical_view_all,
                'medical.create' => $request->medical_create,
                'medical.update' => $request->medical_update,
                'medical.updateall' => $request->medical_update_all,
                'medical.delete' => $request->medical_delete,
                'medical.deleteall' => $request->medical_delete_all,

                'musaned.view'   => $request->musaned_view,
                'musaned.viewall'   => $request->musaned_view_all,
                'musaned.create' => $request->musaned_create,
                'musaned.update' => $request->musaned_update,
                'musaned.updateall' => $request->musaned_update_all,
                'musaned.delete' => $request->musaned_delete,
                'musaned.deleteall' => $request->musaned_delete_all,

                'okala.view'   => $request->okala_view,
                'okala.viewall'   => $request->okala_view_all,
                'okala.create' => $request->okala_create,
                'okala.update' => $request->okala_update,
                'okala.updateall' => $request->okala_update_all,
                'okala.delete' => $request->okala_delete,
                'okala.deleteall' => $request->okala_delete_all,

                'mofa.view'   => $request->mofa_view,
                'mofa.viewall'   => $request->mofa_view_all,
                'mofa.create' => $request->mofa_create,
                'mofa.update' => $request->mofa_update,
                'mofa.updateall' => $request->mofa_update_all,
                'mofa.delete' => $request->mofa_delete,
                'mofa.deleteall' => $request->mofa_delete_all,

                'stamping.view'   => $request->stamping_view,
                'stamping.viewall'   => $request->stamping_view_all,
                'stamping.create' => $request->stamping_create,
                'stamping.update' => $request->stamping_update,
                'stamping.updateall' => $request->stamping_update_all,
                'stamping.delete' => $request->stamping_delete,
                'stamping.deleteall' => $request->stamping_delete_all,

                'finger.view'   => $request->finger_view,
                'finger.viewall'   => $request->finger_view_all,
                'finger.create' => $request->finger_create,
                'finger.update' => $request->finger_update,
                'finger.updateall' => $request->finger_update_all,
                'finger.delete' => $request->finger_delete,
                'finger.deleteall' => $request->finger_delete_all,

                'manpower.view'   => $request->manpower_view,
                'manpower.viewall'   => $request->manpower_view_all,
                'manpower.create' => $request->manpower_create,
                'manpower.update' => $request->manpower_update,
                'manpower.updateall' => $request->manpower_update_all,
                'manpower.delete' => $request->manpower_delete,
                'manpower.deleteall' => $request->manpower_delete_all,

                'flight.view'   => $request->flight_view,
                'flight.viewall'   => $request->flight_view_all,
                'flight.create' => $request->flight_create,
                'flight.update' => $request->flight_update,
                'flight.updateall' => $request->flight_update_all,
                'flight.delete' => $request->flight_delete,
                'flight.deleteall' => $request->flight_delete_all,

                'role.view'   => $request->role_view,
                'role.viewall'   => $request->role_view_all,
                'role.create' => $request->role_create,
                'role.update' => $request->role_update,
                'role.updateall' => $request->role_update_all,
                'role.delete' => $request->role_delete,
                'role.deleteall' => $request->role_delete_all,
                
                'account.view'   => $request->account_view,
                'account.viewall'   => $request->account_view_all,
                'account.create' => $request->account_create,
                'account.update' => $request->account_update,
                'account.updateall' => $request->account_update_all,
                'account.delete' => $request->account_delete,
                'account.deleteall' => $request->account_delete_all,
            ];

            $role->permissions2 = json_encode([
                'contact_view'   => $request->contact_view,   
                'contact_viewall'   => $request->contact_view_all,   
                'contact_create' => $request->contact_create,
                'contact_update' => $request->contact_update,
                'contact_updateall' => $request->contact_update_all,
                'contact_delete' => $request->contact_delete,
                'contact_deleteall' => $request->contact_delete_all,

                'category_view'   => $request->project_category_view,
                'category_viewall'   => $request->project_category_view_all,
                'category_create' => $request->project_category_create,
                'category_update' => $request->project_category_update,
                'category_updateall' => $request->project_category_update_all,
                'category_delete' => $request->project_category_delete,
                'category_deleteall' => $request->project_category_delete_all,

                'project_view'   => $request->project_view,
                'project_viewall'   => $request->project_view_all,
                'project_create' => $request->project_create,
                'project_update' => $request->project_update,
                'project_updateall' => $request->project_update_all,
                'project_delete' => $request->project_delete,
                'project_deleteall' => $request->project_delete_all,

                'purpose_view'   => $request->purpose_view,
                'purpose_viewall'   => $request->purpose_view_all,
                'purpose_create' => $request->purpose_create,
                'purpose_update' => $request->purpose_update,
                'purpose_updateall' => $request->purpose_update_all,
                'purpose_delete' => $request->purpose_delete,
                'purpose_deleteall' => $request->purpose_delete_all,

                'income_view'   => $request->income_view,
                'income_viewall'   => $request->income_view_all,
                'income_create' => $request->income_create,
                'income_update' => $request->income_update,
                'income_updateall' => $request->income_update_all,
                'income_delete' => $request->income_delete,
                'income_deleteall' => $request->income_delete_all,

                'expense_view'   => $request->expense_view,
                'expense_viewall'   => $request->expense_view_all,
                'expense_create' => $request->expense_create,
                'expense_update' => $request->expense_update,
                'expense_updateall' => $request->expense_update_all,
                'expense_delete' => $request->expense_delete,
                'expense_deleteall' => $request->expense_delete_all,

                'invoice_view'   => $request->invoice_view,
                'invoice_viewall'   => $request->invoice_view_all,
                'invoice_create' => $request->invoice_create,
                'invoice_update' => $request->invoice_update,
                'invoice_updateall' => $request->invoice_update_all,
                'invoice_delete' => $request->invoice_delete,
                'invoice_deleteall' => $request->invoice_delete_all,

                'payment_view'   => $request->payment_view,
                'payment_viewall'   => $request->payment_view_all,
                'payment_create' => $request->payment_create,
                'payment_update' => $request->payment_update,
                'payment_updateall' => $request->payment_update_all,
                'payment_delete' => $request->payment_delete,
                'payment_deleteall' => $request->payment_delete_all,

                'recuiting_view'   => $request->recuiting_view,
                'recuiting_viewall'   => $request->recuiting_view_all,
                'recuiting_create' => $request->recuiting_create,
                'recuiting_update' => $request->recuiting_update,
                'recuiting_updateall' => $request->recuiting_update_all,
                'recuiting_delete' => $request->recuiting_delete,
                'recuiting_deleteall' => $request->recuiting_delete_all,

                'medical_view'   => $request->medical_view,
                'medical_viewall'   => $request->medical_view_all,
                'medical_create' => $request->medical_create,
                'medical_update' => $request->medical_update,
                'medical_updateall' => $request->medical_update_all,
                'medical_delete' => $request->medical_delete,
                'medical_deleteall' => $request->medical_delete_all,

                'musaned_view'   => $request->musaned_view,
                'musaned_viewall'   => $request->musaned_view_all,
                'musaned_create' => $request->musaned_create,
                'musaned_update' => $request->musaned_update,
                'musaned_updateall' => $request->musaned_update_all,
                'musaned_delete' => $request->musaned_delete,
                'musaned_deleteall' => $request->musaned_delete_all,

                'okala_view'   => $request->okala_view,
                'okala_viewall'   => $request->okala_view_all,
                'okala_create' => $request->okala_create,
                'okala_update' => $request->okala_update,
                'okala_updateall' => $request->okala_update_all,
                'okala_delete' => $request->okala_delete,
                'okala_deleteall' => $request->okala_delete_all,

                'mofa_view'   => $request->mofa_view,
                'mofa_viewall'   => $request->mofa_view_all,
                'mofa_create' => $request->mofa_create,
                'mofa_update' => $request->mofa_update,
                'mofa_updateall' => $request->mofa_update_all,
                'mofa_delete' => $request->mofa_delete,
                'mofa_deleteall' => $request->mofa_delete_all,

                'stamping_view'   => $request->stamping_view,
                'stamping_viewall'   => $request->stamping_view_all,
                'stamping_create' => $request->stamping_create,
                'stamping_update' => $request->stamping_update,
                'stamping_updateall' => $request->stamping_update_all,
                'stamping_delete' => $request->stamping_delete,
                'stamping_deleteall' => $request->stamping_delete_all,

                'finger_view'   => $request->finger_view,
                'finger_viewall'   => $request->finger_view_all,
                'finger_create' => $request->finger_create,
                'finger_update' => $request->finger_update,
                'finger_updateall' => $request->finger_update_all,
                'finger_delete' => $request->finger_delete,
                'finger_deleteall' => $request->finger_delete_all,

                'manpower_view'   => $request->manpower_view,
                'manpower_viewall'   => $request->manpower_view_all,
                'manpower_create' => $request->manpower_create,
                'manpower_update' => $request->manpower_update,
                'manpower_updateall' => $request->manpower_update_all,
                'manpower_delete' => $request->manpower_delete,
                'manpower_deleteall' => $request->manpower_delete_all,

                'flight_view'   => $request->flight_view,
                'flight_viewall'   => $request->flight_view_all,
                'flight_create' => $request->flight_create,
                'flight_update' => $request->flight_update,
                'flight_updateall' => $request->flight_update_all,
                'flight_delete' => $request->flight_delete,
                'flight_deleteall' => $request->flight_delete_all,


                'role_view'   => $request->role_view,
                'role_viewall'   => $request->role_view_all,
                'role_create' => $request->role_create,
                'role_update' => $request->role_update,
                'role_updateall' => $request->role_update_all,
                'role_delete' => $request->role_delete,
                'role_deleteall' => $request->role_delete_all,
                
                'account_view'   => $request->account_view,
                'account_viewall'   => $request->account_view_all,
                'account_create' => $request->account_create,
                'account_update' => $request->account_update,
                'account_updateall' => $request->account_update_all,
                'account_delete' => $request->account_delete,
                'account_deleteall' => $request->account_delete_all,
            ]);

            $log_user = Auth()->user();
            $role->updated_by = $log_user->id;

            if($role->save()){
                return new RoleResource($role);
            }
        }
        catch (QueryException $e) {
            return response()->json(['error'=>'Role name must be unique'],400);
        }
       
        
    }

    
    public function destroy($id)
    {
        $role = Sentinel::findRoleById($id);


        // $guest = Sentinel::findRoleByName('Guest');
        // if($id != $guest->id){
        //     if($role->delete()){
        //         return new RoleResource($role);
        //     }
        // }
        // else{
        //     return response()->json("Not Possible",401);
        // }

        if($role->delete()){
            return new RoleResource($role);
        }
        
    }

    public function getPermission($id)
    {
        $role = Sentinel::findRoleById($id);
        $contact_view   = $role->permissions["contact.view"];
        $contact_create = $role->permissions["contact.create"];
        $contact_update = $role->permissions["contact.update"];
        $contact_delete = $role->permissions["contact.delete"];

        $permission = ['contact_view'=>$contact_view,'contact_create'=>$contact_create,'contact_update'=>$contact_update,'contact_delete'=>$contact_delete];
        return response()->json($permission,200);
    }

    public function updatePermission(Request $request)
    {
        $role_id        = $request->input('role_id');
        $contact_view   = $request->input('contact_view');
        $contact_create = $request->input('contact_create');
        $contact_update = $request->input('contact_update');
        $contact_delete = $request->input('contact_delete');

        $role = Sentinel::findRoleById($role_id);

        $role->permissions = [
            'contact.view'   => $contact_view,
            'contact.create' => $contact_create,
            'contact.update' => $contact_update,
            'contact.delete' => $contact_delete,
        ];
        $role->save();
        $contact_view   = $role->permissions["contact.view"];
        $contact_create = $role->permissions["contact.create"];
        $contact_update = $role->permissions["contact.update"];
        $contact_delete = $role->permissions["contact.delete"];

        $permission = ['contact_view'=>$contact_view,'contact_create'=>$contact_create,'contact_update'=>$contact_update,'contact_delete'=>$contact_delete];
        return response()->json($permission,200);
    }


    public function testRole(){

       $role_info = DB::table('role_users')
        ->join('users', 'users.id', '=', 'role_users.user_id')
        ->join('roles', 'roles.id', '=', 'role_users.role_id')
        ->select('users.name as user_name','users.email','roles.name as role_name','role_users.*')
        ->get();

        return response()->json($role_info,200);
    }

    public function getAssignRole(){

      $role_info = DB::table('role_users')->whereNotIn('role_id', [1,2])
        ->join('users', 'users.id', '=', 'role_users.user_id')
        ->join('roles', 'roles.id', '=', 'role_users.role_id')
        ->select('users.name as user_name','users.email','roles.name as role_name','role_users.*')
        ->get();

      return response()->json($role_info,200);
    }

    public function updateAssignRole(Request $request){

        $role_id     = $request->role_id;
        $old_role_id = $request->old_role_id;
        $user_id     = $request->user_id;

        $user = Sentinel::findById($user_id);
        $old_role = Sentinel::findRoleById($old_role_id);

        if($old_role){
            $old_role->users()->detach($user);
        }
        
        $role = Sentinel::findRoleById($role_id);
        $role->users()->attach($user);

      $role_info = DB::table('role_users')
        ->join('users', 'users.id', '=', 'role_users.user_id')
        ->join('roles', 'roles.id', '=', 'role_users.role_id')
        ->select('users.name as user_name','users.email','roles.name as role_name','role_users.*')
        ->where('users.id', $user_id)
        ->get();

      return response()->json($role_info,200);
    }
}
