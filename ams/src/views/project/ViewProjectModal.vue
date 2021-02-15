<template>
    <b-modal title="Project"  no-close-on-backdrop hide-footer size="xl" v-model="largeModal"  @ok="largeModal = false">
        <form>
            <div class="form-group row">
                <div class="col-sm-5">
                    <p><b>Name:</b> {{project.name}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Category:</b> {{project.category}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Type:</b> {{project.type != 1 ? 'Flat':'Plot'}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Status:</b> {{project.status == 1 ? 'Active':'Expired'}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Block No:</b> {{project.block_no}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Road No:</b> {{project.road_no}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b >{{project.type != 1 ? 'Flat Size':'Plot Size'}}:</b> {{project.plot_size}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Sales Price:</b> {{project.sales_price}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Purchase Price:</b> {{project.purchase_price}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Location:</b> {{project.location}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Created By:</b> {{project.created_by}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Updated By:</b> {{project.updated_by}}</p>
                </div>
                <div class="col-sm-5">
                    <!-- <p><b>Created At:</b> {{project.created_at.date}}</p> -->
                </div>
                <div class="col-sm-5">
                    <!-- <p><b>Updated At:</b> {{project.updated_at.date}}</p> -->
                </div>
                <div class="col-sm-5">
                    <img style="height:150px;width:200px;" :src="project.image" alt="Not found">
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
export default {
    data(){
        return{
            largeModal:false,
            project:''
        }
    },
    methods:{
        openModal(project){
            this.largeModal = true
            this.project = project
        }
    }
}
</script>

<style>

</style>
