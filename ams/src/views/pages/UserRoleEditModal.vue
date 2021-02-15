<template>
    <b-modal title="Role" no-close-on-backdrop hide-footer size="xl"  v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="updateRole" >
            <div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Role Name</label>
                    <div class="col-sm-10">
                    <input name="Name" v-validate="'required'" v-model="rolePermission.name" type="text" class="form-control" id="inputPassword3" placeholder="Role Name">
                    <div v-show="errors.has('Name')" class="help-block alert alert-danger">
                        {{ errors.first('Name') }}
                    </div>
                    </div>
                </div>
            </div>
            <div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" :class="this.tab==1?'active':''" @click="tabswitching(1)"><i class="fas fa-info-circle"></i><span>Other's</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="this.tab==2?'active':''" @click="tabswitching(2)"><i class="fas fa-graduation-cap"></i><span>Recuiting</span></a>
                    </li>
                </ul>
            </div>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Module</th>
                        <th scope="col">View</th>
                        <th scope="col">View All</th>
                        <th scope="col">Create</th>
                        <th scope="col">Update</th>
                        <th scope="col">Update All</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Delete All</th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-if="tab==1">
                        <td>Contact</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.contact_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.contact_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.contact_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.contact_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.contact_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.contact_delete"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.contact_delete_all"  /></td>
                    </tr>
                    <tr v-if="tab==1">
                        <td>Project Category</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.project_category_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.project_category_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_category_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_category_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_category_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_category_delete"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_category_delete_all"  /></td>
                    </tr>
                    <tr v-if="tab==1">
                        <td>Project</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.project_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.project_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_delete"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.project_delete_all"  /></td>
                    </tr>
                    <tr v-if="tab==1">
                        <td>Purpose</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.purpose_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.purpose_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.purpose_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.purpose_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.purpose_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.purpose_delete"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.purpose_delete_all"  /></td>
                    </tr>
                    <tr v-if="tab==1">
                        <td>Income</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.income_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.income_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.income_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.income_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.income_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.income_delete"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.income_delete_all"  /></td>
                    </tr>
                    <tr v-if="tab==1">
                        <td>Expense</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.expense_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.expense_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.expense_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.expense_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.expense_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.expense_delete"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.expense_delete_all"  /></td>
                    </tr>
                    <tr v-if="tab==1">
                        <td>Invoice</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.invoice_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.invoice_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.invoice_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.invoice_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.invoice_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.invoice_delete"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.invoice_delete_all"  /></td>
                    </tr>
                    <tr v-if="tab==1">
                        <td>Payment Receive</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.payment_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.payment_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.payment_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.payment_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.payment_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.payment_delete"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.payment_delete_all"  /></td>
                    </tr>
                    <tr v-if="tab==1">
                        <td>User Role</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.role_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.role_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.role_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.role_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.role_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.role_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.role_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Recuiting</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.recuiting_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.recuiting_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.recuiting_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.recuiting_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.recuiting_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.recuiting_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.recuiting_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Medical</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.medical_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.medical_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.medical_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.medical_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.medical_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.medical_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.medical_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Musaned</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.musaned_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.musaned_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.musaned_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.musaned_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.musaned_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.musaned_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.musaned_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Okala</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.okala_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.okala_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.okala_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.okala_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.okala_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.okala_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.okala_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Mofa</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.mofa_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.mofa_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.mofa_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.mofa_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.mofa_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.mofa_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.mofa_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Stamping</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.stamping_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.stamping_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.stamping_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.stamping_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.stamping_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.stamping_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.stamping_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Finger</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.finger_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.finger_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.finger_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.finger_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.finger_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.finger_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.finger_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Training</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.training_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.training_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.training_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.training_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.training_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.training_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.training_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Manpower</td>
                        <td><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.manpower_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.manpower_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.manpower_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.manpower_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.manpower_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.manpower_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.manpower_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Flight</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.flight_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.flight_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.flight_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.flight_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.flight_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.flight_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.flight_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Completed</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.completed_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.completed_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.completed_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.completed_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.completed_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.completed_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.completed_delete_all" /></td>
                    </tr>
                    <tr v-if="tab==2">
                        <td>Delivery</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.account_view"  /></td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill" v-model="rolePermission.account_view_all"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.account_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.account_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.account_update_all" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.account_delete" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="rolePermission.account_delete_all" /></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group row">
                <div class="col-sm-12">
                <input v-if="!addLoader" type="submit" value="Submit" class="btn btn-primary pull-right"/>
                <button v-if="addLoader" class="btn btn-primary pull-right" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Submitting...
                </button>
                <button v-if="!addLoader"  @click.prevent="close" class="btn btn-success pull-right" style="margin-right:5px;">Close</button>
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
import { Switch as cSwitch } from '@coreui/vue'
import axios from 'axios'
import Vue from 'vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate)

import { UPDATE_USER_ROLE} from "../../store/action.type"
// import { ADD_CONTACT_LOADER} from "../../store/mutation.type"
import { mapState,mapGetters } from "vuex"

export default {
    data(){
        return{
            tab:1,
            largeModal:false,
            addLoader:false,
            rolePermission:{
                index:'',
                role_id:'',
                role_name:'',
                contact_view:false,
                contact_view_all:false,
                contact_create:false,
                contact_update:false,
                contact_update_all:false,
                contact_delete:false,
                contact_delete_all:false,

                project_category_view:false,
                project_category_view_all:false,
                project_category_create:false,
                project_category_update:false,
                project_category_update_all:false,
                project_category_delete:false,
                project_category_delete_all:false,

                project_view:false,
                project_view_all:false,
                project_create:false,
                project_update:false,
                project_update_all:false,
                project_delete:true,
                project_delete_all:false,

                purpose_view:false,
                purpose_view_all:false,
                purpose_create:false,
                purpose_update:false,
                purpose_update_all:false,
                purpose_delete:true,
                purpose_delete_all:false,

                income_view:false,
                income_view_all:false,
                income_create:false,
                income_update:false,
                income_update_all:false,
                income_delete:false,
                income_delete_all:false,

                expense_view:false,
                expense_view_all:false,
                expense_create:false,
                expense_update:false,
                expense_update_all:false,
                expense_delete:false,
                expense_delete_all:false,

                role_view:false,
                role_view_all:false,
                role_create:false,
                role_update:false,
                role_update_all:false,
                role_delete:false,
                role_delete_all:false,

                invoice_view:false,
                invoice_view_all:false,
                invoice_create:false,
                invoice_update:false,
                invoice_update_all:false,
                invoice_delete:false,
                invoice_delete_all:false,

                payment_view:false,
                payment_view_all:false,
                payment_create:false,
                payment_update:false,
                payment_update_all:false,
                payment_delete:false,
                payment_delete_all:false,
                
                recuiting_view:false,
                recuiting_view_all:false,
                recuiting_create:false,
                recuiting_update:false,
                recuiting_update_all:false,
                recuiting_delete:false,
                recuiting_delete_all:false,

                medical_view:false,
                medical_view_all:false,
                medical_create:false,
                medical_update:false,
                medical_update_all:false,
                medical_delete:false,
                medical_delete_all:false,

                musaned_view:false,
                musaned_view_all:false,
                musaned_create:false,
                musaned_update:false,
                musaned_update_all:false,
                musaned_delete:false,
                musaned_delete_all:false,

                okala_view:false,
                okala_view_all:false,
                okala_create:false,
                okala_update:false,
                okala_update_all:false,
                okala_delete:false,
                okala_delete_all:false,

                mofa_view:false,
                mofa_view_all:false,
                mofa_create:false,
                mofa_update:false,
                mofa_update_all:false,
                mofa_delete:false,
                mofa_delete_all:false,

                stamping_view:false,
                stamping_view_all:false,
                stamping_create:false,
                stamping_update:false,
                stamping_update_all:false,
                stamping_delete:false,
                stamping_delete_all:false,

                finger_view:false,
                finger_view_all:false,
                finger_create:false,
                finger_update:false,
                finger_update_all:false,
                finger_delete:false,
                finger_delete_all:false,

                training_view:false,
                training_view_all:false,
                training_create:false,
                training_update:false,
                training_update_all:false,
                training_delete:false,
                training_delete_all:false,

                manpower_view:false,
                manpower_view_all:false,
                manpower_create:false,
                manpower_update:false,
                manpower_update_all:false,
                manpower_delete:false,
                manpower_delete_all:false,

                flight_view:false,
                flight_view_all:false,
                flight_create:false,
                flight_update:false,
                flight_update_all:false,
                flight_delete:false,
                flight_delete_all:false,

                completed_view:false,
                completed_view_all:false,
                completed_create:false,
                completed_update:false,
                completed_update_all:false,
                completed_delete:false,
                completed_delete_all:false,

                account_view:false,
                account_view_all:false,
                account_create:false,
                account_update:false,
                account_update_all:false,
                account_delete:false,
                account_delete_all:false,
                

            }
        }
    },
    methods:{
        tabswitching(val){
            this.tab = val;
        },
        updateRole () {
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.rolePermission
                    var index = this.index
                    this.addLoader = true
                    this.$store.dispatch('UPDATE_USER_ROLE',{data,index})
                    .then(response=>{
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Role Updated Successsfully"})
                        
                    })
                    .catch(error=>{
                        this.addLoader = false; 
                        this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
                    });
                }
                
            })
            
        },
        openModal(user_role,index){
            console.log(user_role)
                this.index = index,
                this.largeModal = true, 
                this.rolePermission.role_id = user_role.id
                this.rolePermission.name = user_role.name
                this.rolePermission.contact_view = user_role.permission.contact_view
                this.rolePermission.contact_view_all = user_role.permission.contact_viewall
                this.rolePermission.contact_create = user_role.permission.contact_create
                this.rolePermission.contact_update = user_role.permission.contact_update
                this.rolePermission.contact_update_all = user_role.permission.contact_updateall
                this.rolePermission.contact_delete = user_role.permission.contact_delete
                this.rolePermission.contact_delete_all = user_role.permission.contact_deleteall

                this.rolePermission.project_category_view = user_role.permission.category_view
                this.rolePermission.project_category_view_all = user_role.permission.category_viewall
                this.rolePermission.project_category_create = user_role.permission.category_create
                this.rolePermission.project_category_update = user_role.permission.category_update
                this.rolePermission.project_category_update_all = user_role.permission.category_updateall
                this.rolePermission.project_category_delete = user_role.permission.category_delete
                this.rolePermission.project_category_delete_all = user_role.permission.category_deleteall 

                this.rolePermission.project_view = user_role.permission.project_view
                this.rolePermission.project_view_all = user_role.permission.project_viewall
                this.rolePermission.project_create = user_role.permission.project_create
                this.rolePermission.project_update = user_role.permission.project_update
                this.rolePermission.project_update_all = user_role.permission.project_updateall
                this.rolePermission.project_delete = user_role.permission.project_delete
                this.rolePermission.project_delete_all = user_role.permission.project_deleteall

                this.rolePermission.purpose_view = user_role.permission.purpose_view
                this.rolePermission.purpose_view_all = user_role.permission.purpose_viewall
                this.rolePermission.purpose_create = user_role.permission.purpose_create
                this.rolePermission.purpose_update = user_role.permission.purpose_update
                this.rolePermission.purpose_update_all = user_role.permission.purpose_updateall
                this.rolePermission.purpose_delete = user_role.permission.purpose_delete
                this.rolePermission.purpose_delete_all = user_role.permission.purpose_deleteall

                this.rolePermission.income_view = user_role.permission.income_view
                this.rolePermission.income_view_all = user_role.permission.income_viewall
                this.rolePermission.income_create = user_role.permission.income_create
                this.rolePermission.income_update = user_role.permission.income_update
                this.rolePermission.income_update_all = user_role.permission.income_updateall
                this.rolePermission.income_delete = user_role.permission.income_delete
                this.rolePermission.income_delete_all = user_role.permission.income_deleteall

                this.rolePermission.expense_view = user_role.permission.expense_view
                this.rolePermission.expense_view_all = user_role.permission.expense_viewall
                this.rolePermission.expense_create = user_role.permission.expense_create
                this.rolePermission.expense_update = user_role.permission.expense_update
                this.rolePermission.expense_update_all = user_role.permission.expense_updateall
                this.rolePermission.expense_delete = user_role.permission.expense_delete
                this.rolePermission.expense_delete_all = user_role.permission.expense_deleteall

                this.rolePermission.role_view = user_role.permission.role_view
                this.rolePermission.role_view_all = user_role.permission.role_viewall
                this.rolePermission.role_create = user_role.permission.role_create
                this.rolePermission.role_update = user_role.permission.role_update
                this.rolePermission.role_update_all = user_role.permission.role_updateall
                this.rolePermission.role_delete = user_role.permission.role_delete
                this.rolePermission.role_delete_all = user_role.permission.role_deleteall
                
                this.rolePermission.invoice_view = user_role.permission.invoice_view
                this.rolePermission.invoice_view_all = user_role.permission.invoice_viewall
                this.rolePermission.invoice_create = user_role.permission.invoice_create
                this.rolePermission.invoice_update = user_role.permission.invoice_update
                this.rolePermission.invoice_update_all = user_role.permission.invoice_updateall
                this.rolePermission.invoice_delete = user_role.permission.invoice_delete
                this.rolePermission.invoice_delete_all = user_role.permission.invoice_deleteall

                this.rolePermission.payment_view = user_role.permission.payment_view
                this.rolePermission.payment_view_all = user_role.permission.payment_viewall
                this.rolePermission.payment_create = user_role.permission.payment_create
                this.rolePermission.payment_update = user_role.permission.payment_update
                this.rolePermission.payment_update_all = user_role.permission.payment_updateall
                this.rolePermission.payment_delete = user_role.permission.payment_delete
                this.rolePermission.payment_delete_all = user_role.permission.payment_deleteall
                
                this.rolePermission.recuiting_view = user_role.permission.recuiting_view
                this.rolePermission.recuiting_view_all = user_role.permission.recuiting_viewall
                this.rolePermission.recuiting_create = user_role.permission.recuiting_create
                this.rolePermission.recuiting_update = user_role.permission.recuiting_update
                this.rolePermission.recuiting_update_all = user_role.permission.recuiting_updateall
                this.rolePermission.recuiting_delete = user_role.permission.recuiting_delete
                this.rolePermission.recuiting_delete_all = user_role.permission.recuiting_deleteall

                this.rolePermission.medical_view = user_role.permission.medical_view
                this.rolePermission.medical_view_all = user_role.permission.medical_viewall
                this.rolePermission.medical_create = user_role.permission.medical_create
                this.rolePermission.medical_update = user_role.permission.medical_update
                this.rolePermission.medical_update_all = user_role.permission.medical_updateall
                this.rolePermission.medical_delete = user_role.permission.medical_delete
                this.rolePermission.medical_delete_all = user_role.permission.medical_deleteall

                this.rolePermission.musaned_view = user_role.permission.musaned_view
                this.rolePermission.musaned_view_all = user_role.permission.musaned_viewall
                this.rolePermission.musaned_create = user_role.permission.musaned_create
                this.rolePermission.musaned_update = user_role.permission.musaned_update
                this.rolePermission.musaned_update_all = user_role.permission.musaned_updateall
                this.rolePermission.musaned_delete = user_role.permission.musaned_delete
                this.rolePermission.musaned_delete_all = user_role.permission.musaned_deleteall

                this.rolePermission.okala_view = user_role.permission.okala_view
                this.rolePermission.okala_view_all = user_role.permission.okala_viewall
                this.rolePermission.okala_create = user_role.permission.okala_create
                this.rolePermission.okala_update = user_role.permission.okala_update
                this.rolePermission.okala_update_all = user_role.permission.okala_updateall
                this.rolePermission.okala_delete = user_role.permission.okala_delete
                this.rolePermission.okala_delete_all = user_role.permission.okala_deleteall

                this.rolePermission.mofa_view = user_role.permission.mofa_view
                this.rolePermission.mofa_view_all = user_role.permission.mofa_viewall
                this.rolePermission.mofa_create = user_role.permission.mofa_create
                this.rolePermission.mofa_update = user_role.permission.mofa_update
                this.rolePermission.mofa_update_all = user_role.permission.mofa_updateall
                this.rolePermission.mofa_delete = user_role.permission.mofa_delete
                this.rolePermission.mofa_delete_all = user_role.permission.mofa_deleteall

                this.rolePermission.stamping_view = user_role.permission.stamping_view
                this.rolePermission.stamping_view_all = user_role.permission.stamping_viewall
                this.rolePermission.stamping_create = user_role.permission.stamping_create
                this.rolePermission.stamping_update = user_role.permission.stamping_update
                this.rolePermission.stamping_update_all = user_role.permission.stamping_updateall
                this.rolePermission.stamping_delete = user_role.permission.stamping_delete
                this.rolePermission.stamping_delete_all = user_role.permission.stamping_deleteall

                this.rolePermission.training_view = user_role.permission.training_view
                this.rolePermission.training_view_all = user_role.permission.training_viewall
                this.rolePermission.training_create = user_role.permission.training_create
                this.rolePermission.training_update = user_role.permission.training_update
                this.rolePermission.training_update_all = user_role.permission.training_updateall
                this.rolePermission.training_delete = user_role.permission.training_delete
                this.rolePermission.training_delete_all = user_role.permission.training_deleteall

                this.rolePermission.finger_view = user_role.permission.finger_view
                this.rolePermission.finger_view_all = user_role.permission.finger_viewall
                this.rolePermission.finger_create = user_role.permission.finger_create
                this.rolePermission.finger_update = user_role.permission.finger_update
                this.rolePermission.finger_update_all = user_role.permission.finger_updateall
                this.rolePermission.finger_delete = user_role.permission.finger_delete
                this.rolePermission.finger_delete_all = user_role.permission.finger_deleteall

                this.rolePermission.manpower_view = user_role.permission.manpower_view
                this.rolePermission.manpower_view_all = user_role.permission.manpower_viewall
                this.rolePermission.manpower_create = user_role.permission.manpower_create
                this.rolePermission.manpower_update = user_role.permission.manpower_update
                this.rolePermission.manpower_update_all = user_role.permission.manpower_updateall
                this.rolePermission.manpower_delete = user_role.permission.manpower_delete
                this.rolePermission.manpower_delete_all = user_role.permission.manpower_deleteall

                this.rolePermission.flight_view = user_role.permission.flight_view
                this.rolePermission.flight_view_all = user_role.permission.flight_viewall
                this.rolePermission.flight_create = user_role.permission.flight_create
                this.rolePermission.flight_update = user_role.permission.flight_update
                this.rolePermission.flight_update_all = user_role.permission.flight_updateall
                this.rolePermission.flight_delete = user_role.permission.flight_delete
                this.rolePermission.flight_delete_all = user_role.permission.flight_deleteall

                this.rolePermission.completed_view = user_role.permission.completed_view
                this.rolePermission.completed_view_all = user_role.permission.completed_viewall
                this.rolePermission.completed_create = user_role.permission.completed_create
                this.rolePermission.completed_update = user_role.permission.completed_update
                this.rolePermission.completed_update_all = user_role.permission.completed_updateall
                this.rolePermission.completed_delete = user_role.permission.completed_delete
                this.rolePermission.completed_delete_all = user_role.permission.completed_deleteall

                this.rolePermission.account_view = user_role.permission.account_view
                this.rolePermission.account_view_all = user_role.permission.account_viewall
                this.rolePermission.account_create = user_role.permission.account_create
                this.rolePermission.account_update = user_role.permission.account_update
                this.rolePermission.account_update_all = user_role.permission.account_updateall
                this.rolePermission.account_delete = user_role.permission.account_delete
                this.rolePermission.account_delete_all = user_role.permission.account_deleteall
        },
        close(){
            this.largeModal = false
        }

    },
    components:{
        cSwitch
    }
}
</script>

<style>

</style>
