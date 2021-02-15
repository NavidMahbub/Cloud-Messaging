<template>
    <b-modal title="Project" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="addProject">
             <div class="container custom_modal_body">
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'"  name="Category" v-model="newProject.project_category_id"  class="form-control" >
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
                        <select  v-model="newProject.type" v-validate="'required'" name="Type"  id="inputState" class="form-control" >
                            <option value="" >Select Type</option>
                            <option value="1" >Service</option>
                            <option value="2" >Product</option>
                        </select>
                        <p  v-show="errors.has('Type')" style="color:red">* {{ errors.first('Type') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Item Name</label>
                    <div class="col-sm-4">
                        <input name="Name" v-validate="'required'" v-model="newProject.name" type="text" class="form-control" id="inputPassword3" placeholder="Project Name">
                        <p  v-show="errors.has('Name')" style="color:red">* {{ errors.first('Name') }}</p>
                    </div>

                    <label for="inputPassword3" class="col-sm-2 col-form-label">Sales Price</label>
                    <div class="col-sm-4">
                        <input name="Sales price" v-validate="'required'" v-model="newProject.sales_price" type="number" step="0.1" class="form-control"  placeholder="Sales Price">
                        <p  v-show="errors.has('Sales price')" style="color:red">* {{ errors.first('Sales price') }}</p>
                    </div>
                </div>
                <div  class="form-group row">
                </div>
                
               
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Purchase Price</label>
                    <div class="col-sm-4">
                    <input v-model="newProject.purchase_price" step="0.1" type="number" class="form-control"  placeholder="Purchase Price">
                    </div>
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
import Vue from 'vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate)
import { ADD_PROJECT,All_PROJECT_CATEGORY} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
    data(){
        return{
            largeModal:false,
            addLoader:false,
            url:null,
            newProject:{
                name:'',
                status:1,
                sales_price:'',
                purchase_price:'',
                location:'',
                block_no:'',
                road_no:'',
                plot_size:'',
                project_category_id:'',
                plot_facing:'',
                type:'',
                image:'',
                not_edit_image:10
            }
        }
    },
    methods:{
        openModal(){
            this.largeModal = true
        },
        addProject(){
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.newProject
                    this.addLoader = true
                    this.$store.dispatch('ADD_PROJECT',data)
                    .then(response=>{
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Project Added Successsfully"})
                        
                    })
                    .catch(error=>{
                        this.addLoader = false; 
                        this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
                    });
                }
                
            })
        },
        allCategory(){
            this.$store.dispatch('All_PROJECT_CATEGORY')
        },
        imageChanged(e) {
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
                this.newProject.image = e.target.result
                this.newProject.not_edit_image = 11
            }
            this.url = URL.createObjectURL(e.target.files[0]);
        },
        close(){
            this.largeModal = false
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
#preview {
        height: 120px;
        width: 70%;
    }
    #preview img{
        height: 100%;
        width: 100%;
    }
</style>
