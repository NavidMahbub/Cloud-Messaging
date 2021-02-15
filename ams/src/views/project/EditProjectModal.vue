<template>
    <b-modal title="Project" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="updateProject">
             <div class="container custom_modal_body">
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Project Category</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'"  name="Category" v-model="editProject.project_category_id"  class="form-control" >
                                <option value="" >Select Category</option>
                                <option v-if="category.status == 1 " v-for="(category,index) in project_categories" :key="index" :value="category.id">{{category.name}}</option>
                            </select>
                            <span v-if="project_categories.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Category')" style="color:red">* {{ errors.first('Category') }}</p>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-4">
                        <select  v-model="editProject.type" v-validate="'required'" name="Type"  id="inputState" class="form-control" >
                            <option value="" >Select Type</option>
                            <option value="1" >Plot</option>
                            <option value="2" >Flat</option>
                        </select>
                        <p  v-show="errors.has('Type')" style="color:red">* {{ errors.first('Type') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-4">
                        <input name="Name" v-validate="'required'" v-model="editProject.name" type="text" class="form-control" id="inputPassword3" placeholder="Project Name">
                        <p  v-show="errors.has('Name')" style="color:red">* {{ errors.first('Name') }}</p>
                    </div>

                    <label for="inputPassword3" class="col-sm-2 col-form-label">Block No</label>
                    <div class="col-sm-4">
                        <input v-model="editProject.block_no" type="text" class="form-control" id="inputPassword3" placeholder="Block No">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Road No</label>
                    <div class="col-sm-4">
                        <input v-model="editProject.road_no" type="text" class="form-control" id="inputPassword3" placeholder="Road No">
                    </div>

                    <label for="inputPassword3" class="col-sm-2 col-form-label">Plot/Flat Facing</label>
                    <div class="col-sm-4">
                        <input v-model="editProject.plot_facing" type="text" class="form-control" id="inputPassword3" placeholder="Plot Facing">
                    </div>
                </div>
                <div v-if="editProject.type == 1" class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Plot No</label>
                    <div class="col-sm-4">
                        <input name="Plot no" v-validate="'required'"     v-model="editProject.plot_no" type="text" class="form-control" id="inputPassword3" placeholder="Plot No">
                        <p  v-show="errors.has('Plot no')" style="color:red">* {{ errors.first('Plot no') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Plot Size</label>
                    <div class="col-sm-4">
                        <input name="Plot size" v-validate="'required'" v-model="editProject.plot_size" type="text" class="form-control" id="inputPassword3" placeholder="Plot Size">
                        <p  v-show="errors.has('Plot size')" style="color:red">* {{ errors.first('Plot size') }}</p>
                    </div>
                </div>
                <div v-if="editProject.type == 2" class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Flat No</label>
                    <div class="col-sm-4">
                        <input name="Flat no" v-validate="'required'" v-model="editProject.plot_no" type="text" class="form-control" id="inputPassword3" placeholder="Plot No">
                        <p  v-show="errors.has('Flat no')" style="color:red">* {{ errors.first('Flat no') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Flat Size</label>
                    <div class="col-sm-4">
                        <input name="Flat size"  v-validate="'required'" v-model="editProject.plot_size" type="text" class="form-control" id="inputPassword3" placeholder="Plot Size">
                        <p  v-show="errors.has('Flat size')" style="color:red">* {{ errors.first('Flat size') }}</p>
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-4">
                        <div class="row">
                        <div style="margin-left:15px" class="custom-control custom-radio">
                            <input v-model="editProject.status" type="radio" id="customRadio1" name="status" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadio1">Active</label>
                            
                        </div>
                        <div style="margin-left:15px" class="custom-control custom-radio">
                            <input v-model="editProject.status" type="radio" id="customRadio2" name="status"  class="custom-control-input" value="0" >
                            <label class="custom-control-label" for="customRadio2">Expired</label>
                        </div>
                        </div>
                    </div>

                    <label for="inputPassword3" class="col-sm-2 col-form-label">Sales Price</label>
                    <div class="col-sm-4">
                        <input name="Sales price" v-validate="'required'" v-model="editProject.sales_price" type="number" step="0.1" class="form-control" id="inputPassword3" placeholder="Sales Price">
                        <p  v-show="errors.has('Sales price')" style="color:red">* {{ errors.first('Sales price') }}</p>
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Purchase Price</label>
                    <div class="col-sm-4">
                    <input v-model="editProject.purchase_price" step="0.1" type="number" class="form-control" id="inputPassword3" placeholder="Purchase Price">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-4">
                    <input v-model="editProject.location" type="text" class="form-control" id="inputPassword3" placeholder="Location">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-4">
                    <input @change="imageChanged" type="file" class="form-control" id="inputPassword3">
                    </div>
                    <div class="col-sm-6">
                        <div v-if="url" id="preview">
                            <img :src="url" alt="">
                        </div>
                    </div>
                </div>
            </div>
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
import { UPDATE_PROJECT,DELETE_PROJECT,All_PROJECT_CATEGORY} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
    data(){
        return{
            largeModal:false,
            addLoader:false,
            index:'',
            url:null,
            editProject:{
                name:'',
                status:null,
                sales_price:'',
                purchase_price:'',
                location:'',
                block_no:'',
                road_no:'',
                plot_size:'',
                image:'',
                project_category_id:'',
                plot_facing:'',
                type:'',
                project_id:'',
                not_edit_image:1
            }
        }
    },
    methods:{
        close(){
            this.largeModal = false
        },
        openModal(project,index){
            this.largeModal = true
            this.index = index
            this.url = project.image
            this.editProject.name = project.name
            this.editProject.type = project.type
            this.editProject.status = project.status
            this.editProject.project_id = project.id
            this.editProject.project_category_id = project.project_category_id
            this.editProject.plot_size = project.plot_size
            this.editProject.road_no = project.road_no
            this.editProject.block_no = project.block_no
            this.editProject.location = project.location
            this.editProject.purchase_price = project.purchase_price
            this.editProject.sales_price = project.sales_price
            this.editProject.plot_facing = project.plot_facing
            this.editProject.image = project.image
        },
        updateProject(){
            this.addLoader = true;
            var data = this.editProject
            var index = this.index
            this.$store.dispatch('UPDATE_PROJECT',{data,index})
            .then(response=>{
                this.addLoader = false;
                this.largeModal = false
                this.$iziToast.success({position:'topRight',title:'Ok',message:"Project Updated Successsfully"})
                
            })
            .catch(error=>{
                this.addLoader = false; 
                this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
            });
        },
        allCategory(){
            this.$store.dispatch('All_PROJECT_CATEGORY')
        },
        imageChanged(e) {
            // console.log(e.target.files[0])
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
                this.editProject.image = e.target.result
                this.editProject.not_edit_image = 11
            }
            this.url = URL.createObjectURL(e.target.files[0])
            
        }
        
    },
    mounted(){
        this.allCategory()
    },
    computed:{
        ...mapGetters(["project_categories"]),
        
    }
}
</script>

<style>

</style>
