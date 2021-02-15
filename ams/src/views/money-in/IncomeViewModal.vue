<template>
    <b-modal title="Income"  no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form>
            <div class="form-group row">
                <div class="col-sm-6">
                    <p><b>Purpose:</b> {{income.account}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Customer:</b> {{income.customer}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Agent:</b> {{income.agent}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Date:</b> {{income.date}}</p>
                </div>
                <div class="col-sm-3">
                    <p><b>Amount:</b> {{income.amount}}</p>
                </div>
                <div class="col-sm-3">
                    <p><b>Utility Charge:</b> {{income.utility}}</p>
                </div>
                <div class="col-sm-3">
                     <p><b>Car Parking:</b> {{income.car_parking}}</p>
                </div>
                <div class="col-sm-3">
                    <p><b>Registration Cost:</b> {{income.registration_cost}}</p>
                </div>
                <div class="col-sm-3">
                    <p><b>Other Cost:</b> {{income.other_cost}}</p>
                </div>
                <div class="col-sm-3">
                    <p><b>Gift:</b> {{income.gift}}</p>
                </div>
                <div class="col-sm-3">
                    <p><b>Discount:</b> {{income.discount}}</p>
                </div>
                <div  class="col-sm-12">
                    <div style="border-top:2px solid #888">
                         <p ><b>Total:</b><span class="pull-right">{{((parseFloat(income.amount)+parseFloat(income.utility)+parseFloat(income.car_parking)+parseFloat(income.registration_cost)+parseFloat(income.other_cost))-(parseFloat(income.discount)+parseFloat(income.gift)))}}</span> </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <p><b>Note:</b> {{income.note}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Reference:</b> {{income.reference}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Bank Info:</b> {{income.bank_info}}</p>
                </div>
                <div class="col-sm-6">
                   <p><b>Created By:</b> {{income.created_by}}</p>
                </div> 
                <div class="col-sm-6">
                   <p><b>Updated By:</b> {{income.updated_by}}</p>
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
            income:'',
        }
    },
    methods:{
        openModal(income){
            this.largeModal = true
            this.income = income
        },
        
    }

}
</script>

<style>

</style>
