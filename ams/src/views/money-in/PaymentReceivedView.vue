<template>
    <b-modal title="Payment Receive"  no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form>
            <div class="form-group row">
               <div style="margin:0 auto" id="invoice">
                    <div class="toolbar hidden-print">
                        <div class="text-right">
                            <button @click.prevent="print"  class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                        </div>
                        <hr>
                    </div>
                    <div id="print-div" class="invoice overflow-auto">
                        <div style="min-width: 600px">
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
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">BILL TO:</div>
                                        <h2 class="to">{{payment.customer}}</h2>
                                        <!-- <div class="address">{{invoice.customer_address}}</div> -->
                                        <div class="email"><a href="#">{{payment.customer_email}}</a></div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">{{payment.pr_number}}</h1>
                                        <div class="date">Payment Date: {{payment.date}}</div>
                                        <div class="date">Reference Number: {{payment.reference}}</div>
                                        <div class="date">Payment Mode: {{payment.payment_mode == 1 ? "Cash" : "#"}} {{payment.payment_mode == 2 ? "Bank Cheque" : "#"}}</div>
                                    </div>
                                </div>
                                <!-- <table  border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th class="text-left">INVOICE NUMBER</th>
                                            <th class="text-right">INVOICE DATE</th>
                                            <th class="text-right">INVOICE AMOUNT</th>
                                            <th class="text-right">PAYMENT AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(invoice,index) in payment.invoices" :key="index">
                                            <td class="unit">{{invoice.invoice_number}}</td>
                                            <td class="qty">{{invoice.date}}</td>
                                            <td class="qty">{{invoice.total}}</td>
                                            <td class="total">{{invoice.amount}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2">AMOUNT RECEIVED</td>
                                            <td>{{total}}</td>
                                        </tr>
                                    </tfoot>
                                </table> -->
                                  <table  border="0" cellspacing="0" cellpadding="0">
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2">TOTAL INVOICE</td>
                                            <td>{{parseInt(payment.amount)+parseInt(payment.due)}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2">RECEIVED AMOUNT</td>
                                            <td>{{payment.amount}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2">DUE AMOUNT</td>
                                            <td>{{payment.due}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div style="margin-top:30px;" class="thanks">Thank you!</div>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">#</div>
                                </div>
                            </main>
                            <footer>
                                Payment Receive was created on a computer and is valid without the signature and seal.
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
export default {
    data(){
        return{
            largeModal:false,
            payment:{
                invoices:[]
            },
            projects:[]
        }
    },
    methods:{
        openModal(payment){
            this.largeModal = true
            this.payment = payment
            this.allProjects()
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
            var pr_number = this.payment.pr_number
            domtoimage.toJpeg(document.getElementById('print-div'), { quality: 0.95 })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = pr_number+'.jpeg';
                link.href = dataUrl;
                link.click();
            });
        },
        close(){
            this.largeModal = false
        }
    },
    computed:{
        total(){
            var total_amount = 0
            this.payment.invoices.forEach(element =>{
                total_amount = total_amount + element.amount
            })
            return total_amount
        }
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
