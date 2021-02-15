<template>
    <b-modal title="Expense"  no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form>
            <div class="form-group row">
                <div class="col-sm-4">
                    <p><b>Purpose:</b> {{expense.account}}</p>
                </div>
                <div class="col-sm-4">
                    <p><b>Date:</b> {{expense.date}}</p>
                </div>
                <div class="col-sm-4">
                    <p><b>Vendor:</b> {{expense.vendor}}</p>
                </div>
                <div class="col-sm-4">
                    <p><b>Amount:</b> {{expense.amount}}</p>
                </div>
                <div class="col-sm-4">
                    <p><b>Tax:</b> {{expense.tax_total}}</p>
                </div>
                <div  class="col-sm-12">
                    <div style="border-top:2px solid #888">
                         <p ><b>Total:</b><span class="pull-right">{{parseFloat(expense.amount)+parseFloat(expense.tax_total)}}</span> </p>
                    </div>
                </div>
                <div class="col-sm-5">
                    <p><b>Reference:</b> {{expense.reference}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Bank Info:</b> {{expense.bank_info}}</p>
                </div>
                <div class="col-sm-5">
                    <p><b>Note:</b> {{expense.note}}</p>
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
            expense:'',
        }
    },
    methods:{
        openModal(expense){
            this.largeModal = true
            this.expense = expense
        }
    }

}
</script>

<style>

</style>
