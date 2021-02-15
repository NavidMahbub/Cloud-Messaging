<template>
    <b-modal title="Workers Reports"   no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form>
          <b-card no-body class="mb-1" v-for="(list,key) in this.lists" v-bind:key="key">
            <b-card-header header-tag="header" class="p-1" role="tab">
              <b-btn block href="#" v-b-toggle="'tab'+key" variant="info">{{list.name}} ({{list.visas.length}})</b-btn>
            </b-card-header>
            <b-collapse :id="'tab'+key"  accordion="my-accordion" role="tabpanel">
              <b-card-body>
                <div class="container-fluid" style="overflow: auto;">
                    <table id="my-table" class="table table-striped table_fields">
                        <thead>
                            <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Workers Number</th>
                            <th scope="col">Passport Name</th>
                            <th scope="col">Passport Number</th>
                            <th scope="col">Visa Number</th>
                            <th scope="col">Occupation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(visa,index) in list.visas" :key="index">
                                <td>{{visa.created_at}}</td>
                                <td>{{visa.worker_number}}</td>
                                <td>{{visa.passport_name}}</td>
                                <td>{{visa.passport_number}}</td>
                                <td>{{visa.visa_number}}</td>
                                <td>{{visa.occupation}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
              </b-card-body>
            </b-collapse>
          </b-card>
        </form>
    </b-modal>
</template>
<script>
export default {
    props:['lists'],
    data(){
        return{
            largeModal:false,
            contact:'',
        }
    },
    methods:{
        openModal(contact){
            this.largeModal = true
            this.contact = contact
        }
    }

}
</script>

<style>

</style>
