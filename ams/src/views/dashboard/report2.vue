<template>
    <b-modal title="Workers Reports"   no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form>
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
                            <tr v-for="(visa,index) in lists" :key="index">
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
