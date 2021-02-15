<template>
    <b-modal title="Invoice"  no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form>
            <div class="form-group row">
               <div style="margin:0 auto" id="invoice">
                    <div class="toolbar hidden-print">
                        <div class="text-right">
                            
                            <button @click="printInvoice('print-div')"  class="btn btn-info"><i class="fa fa-print"></i>Print</button>
                            <button @click.prevent="print"  class="btn btn-info"><i class="fa fa-print"></i>Download</button>
                        </div>
                        <hr>
                    </div>
                    <div id="print-div" class="invoice overflow-auto">
                        <div style="min-width: 620px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a target="_blank" href="#">
                                            <img style="height:60px;width:160px;" src="../../static/logo.png" data-holder-rendered="true" />
                                            </a>
                                    </div>
                                    <div class="col company-details">
                                         <h2 class="name">
                                            <a target="_blank" href="#">
                                            RUBEL GROUP
                                            </a>
                                        </h2>
                                        <div>1,FAKIRAPOOL(HOTEL NURANI),MOTIJHEEL,DHAKA-1000</div>
                                        <div>+88027-193856</div>
                                        <div>INFO.RUBELBANGLADESH@GMAIL.COM</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col-md-6 invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to">{{invoice.customer}}</h2>
                                        <!-- <div class="address">{{invoice.customer_address}}</div> -->
                                        <div class="email"><a href="mailto:john@example.com">{{invoice.customer_email}}</a></div>
                                    </div>
                                    <div class="col-md-6 invoice-details">
                                        <h2 class="invoice-id">{{invoice.invoice_number}}</h2>
                                        <div class="date"><p>Date of Invoice: {{invoice.date}}</p></div>
                                        <!-- <div class="date">Due Date: {{invoice.due_date}}</div> -->
                                    </div>
                                </div>
                                <table v-if="invoice.invoice_items != null" border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">ITEM</th>
                                            <th class="text-right">QTY</th>
                                            <th class="text-right">RATE</th>
                                            <th class="text-right">DISCOUNT %</th>
                                            <th class="text-right">TAX %</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in invoice.invoice_items" :key="index">
                                            <td class="no">{{index +1}}</td>
                                            <td v-if="project.id == item.project_id" v-for="(project,index) in projects" :key="index" class="text-left"><h3>{{project.name}}</h3></td>
                                            <td class="unit">{{item.quantity}}</td>
                                            <td class="qty">{{item.rate}}</td>
                                            <td class="qty">{{item.discount}}</td>
                                            <td class="qty">{{item.tax}}</td>
                                            <td class="total">{{(item.quantity * item.rate)+((item.quantity * item.rate * item.tax)/100)-((item.quantity * item.rate * item.discount)/100)}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="3">SUBTOTAL</td>
                                            <td>{{invoice.total - invoice.adjustment}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="3">ADJUSTMENT</td>
                                            <td>{{invoice.adjustment}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="3">GRAND TOTAL</td>
                                            <td>{{invoice.total}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <table v-if="invoice.invoice_items == null" border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">VISA</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="no">1</td>
                                            <td v-if="customervisa.id == invoice.visa_id" v-for="(customervisa,index) in customervisas" :key="index" class="text-left"><h3>{{customervisa.worker_number}}</h3></td>
                                            <td class="total">{{invoice.total}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td>SUBTOTAL</td>
                                            <td>{{invoice.total - invoice.adjustment}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>ADJUSTMENT</td>
                                            <td>{{invoice.adjustment}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>GRAND TOTAL</td>
                                            <td>{{invoice.total}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div style="margin-top:30px;" class="thanks">Thank you!</div>
                                <div class="notices">
                                    <div>DUE: {{invoice.due_amount}}</div>
                                    <!-- <div class="notice">{{invoice.due_amount}}</div> -->
                                </div>
                            </main>
                            <footer>
                                Invoice was created on a computer and is valid without the signature and seal.
                            </footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
import axios from 'axios'
import domtoimage from 'dom-to-image'
import { mapState,mapGetters } from "vuex"
export default {
    data(){
        return{
            largeModal:false,
            invoice:'',
            projects:[]
        }
    },
    methods:{
        printInvoice: function(el) {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            var enteredtext = $('#text').val();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            $('#text').html(enteredtext);
        },
        openModal(invoice){
            this.largeModal = true
            this.invoice = invoice
            this.allProjects()
            this.customerVisa(invoice.customer_id)
        },
        allProjects(){
            return new Promise((resolve, reject) => {
                axios.get("api/project-all")
                .then(response => {
                    this.projects = response.data
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                });
            });
        },
        print(){
            // var printContents = document.getElementById("ttest").innerHTML;
            // var originalContents = document.body.innerHTML;
			// document.body.innerHTML =  printContents;
			// window.print();
            // document.body.innerHTML = originalContents;
            var invoice_number = this.invoice.invoice_number
            domtoimage.toJpeg(document.getElementById('print-div'), { quality: 0.95 })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = invoice_number+'.jpeg';
                link.href = dataUrl;
                link.click();
            });
        },
        close(){
            this.largeModal = false
        }
        ,
        customerVisa(id){
            this.customerVisaLoading=true;
            this.$store.dispatch('CUSTOMER_VISA',id)
            .then(response=>{
               this.customerVisaLoading=false; 
            })
            .catch(error=>{
               this.customerVisaLoading=false;       
            });
        },
    },
    computed:{
        ...mapGetters(["customervisas"])
    }

}
</script>




<style>
#invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}

</style>
