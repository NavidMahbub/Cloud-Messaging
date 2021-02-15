<template>
    <div class="card">
        <div class="container-fluid">
            <button type="button" @click="largeModal = true" class="btn btn-primary contct-b pull-left"><i class="fa fa-bookmark-o"></i> Add Booking/Sale</button>
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
            <table class="table table-sm ">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Flat/Plot No</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Bank</th>
                    <th scope="col">Money Receipt</th>
                    <th scope="col">Actual Price</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(payment,index) in payments" :key="index">
                        <th scope="row">{{index + 1}}</th>
                        <td>{{payment.project_name}}</td>
                        <td>{{parseInt(payment.plot_no)+1}}</td>
                        <td>{{payment.client_name}}</td>
                        <td>{{index % 2 == 0 ? 'DBBL':'EBL'}}</td>
                        <td>{{payment.client_id}}</td>
                        <td>{{payment.advance_amount}}</td>
                        <td>{{payment.advance_date}}</td>
                        <td>
                            <i @click="largeModal = true" class="icon-note icons actn"> </i>
                            <i @click="largeModal2 = true" class="icon-eye icons   actn"> </i>
                            <i @click="smallModal = true" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm">
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
                </ul>
            </nav>
            <b-modal  title="Booking/Sale" hide-footer size="lg" v-model="largeModal" @ok="largeModal = false">
                <form>
                    
                    <div >
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Select Project</label>
                            <div class="col-sm-10">
                                <select id="inputState" class="form-control" >
                                    <option value="" >Select Project</option>
                                    <option value="1">Matsoft</option>
                                    <option value="2">Ronstring</option>
                                    <option value="3">Sonair</option>
                                </select>
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Select Plot</label>
                            <div class="col-sm-10">
                                <select id="inputState" class="form-control" >
                                    <option value="" >Select Plot</option>
                                    <option value="1">003</option>
                                    <option value="2">004</option>
                                    <option value="3">005</option>
                                </select>
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Select Client</label>
                            <div class="col-sm-10">
                                <select id="inputState" class="form-control" >
                                    <option value="" >Select Client</option>
                                    <option value="1">Rahim</option>
                                    <option value="2">Karim</option>
                                    <option value="3">Soni</option>
                                </select>
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Actual Price</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Actual Price">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Discount %">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Cash Discont</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Cash Discount">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Gift</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Gift">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Utility Charges</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Utility Charges">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Car Parking</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Car Parking">
                            </div>
                        </div>
                        
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Registration Cost</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Registration Cost">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Vat/Taxes</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Vat/Taxes">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Others</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Others">
                            </div>
                        </div>
                        <div   class="form-group row">
                            <div class="col-sm-2"></div>
                            <div style="border-top:2px solid #ECE8E7;" class="col-sm-10">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 "><p>Total: 232322</p></div>
                            <div class="col-sm-2"></div>
                            <div  class="col-sm-10 "><p>Advance: 10000</p></div>
                            <div class="col-sm-2"></div>
                            <div  class="col-sm-10 "><p>Due: 222322</p></div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Booking Money</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Booking Money">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Money Receipt</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword3" placeholder="Money Receipt">
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Installment</label>
                            <div class="col-sm-4">
                                <select id="inputState" class="form-control" >
                                    <option value="" >Select Type</option>
                                    <option value="1">Weekly</option>
                                    <option value="2">Monthly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputPassword3" placeholder="Interest %">
                            </div>
                            <div class="col-sm-3">
                                <p>Per Installment: 222322</p>
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Select Bank</label>
                            <div class="col-sm-10">
                                <select id="inputState" class="form-control" >
                                    <option value="" >Select Bank</option>
                                    <option value="1">DBBL</option>
                                    <option value="2">EBL</option>
                                </select>
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Bank Note</label>
                            <div class="col-sm-10">
                                <VueEditor></VueEditor>
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                            <input type="date" class="form-control" id="inputPassword3" placeholder="Date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </form>
            </b-modal>
            <b-modal title="Booking/Sale Details" hide-footer size="lg" v-model="largeModal2" @ok="largeModal2 = false">
                <form>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <p><b>Project Name:</b> Ronstring</p>
                            <p><b>Client name:</b> Rahim</p>
                            <p><b>Flat No:</b> 12</p>
                            <p><b>Money Receipt:</b> 10</p>
                            <p><b>Actual Price:</b> 1000000 Tk</p>
                            <p><b>Discount:</b> 10%</p>
                            <p><b>Cash Discount:</b> 15000 Tk</p>
                            <p><b>Gift:</b> 1000 Tk</p>
                            <p><b>Booking Money:</b> 10000 Tk</p>
                            <p><b>Utility Charges:</b> 1000 Tk</p>
                            <p><b>Car Parking:</b> 1000 Tk</p>
                            <p><b>Registration coast:</b> 10000 Tk</p>
                            <p><b>Vat/taxes:</b> 1000 Tk</p>
                            <p><b>Others:</b> 10000 Tk</p>
                            <p><b>Bank:</b> DBBL</p>
                            <p><b>BanK Note:</b> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                            <p><b>Bokking/Sale Date:</b> 12/12/2018</p>
                        </div>
                    </div>
                </form>
            </b-modal>
            <b-modal title="Delete Booking/Sale " size="sm" v-model="smallModal" @ok="smallModal = false">
                <b><p style="color:red">Are you sure to delete</p></b>
            </b-modal>
        </div>
    </div>
</template>

<script>
import data from './advance_payment'
import { VueEditor } from 'vue2-editor'
export default {
    data(){
        return {
            smallModal: false,
            largeModal2: false,
            largeModal: false,
            payments: []
        }
    },
    mounted () {
        this.getData()
    },
    methods:{
        getData(){
            this.payments = data
        }
    },
    components:{
        VueEditor
    }
}
</script>


<style>
 .actn{
     margin-left: 10px;
     cursor: pointer;
 }
 .contct{
     padding-bottom: 10px;
     padding-top: 10px
 }
 .contct-b{
     margin-bottom: 10px;
     margin-top: 10px
 }
 .load{
     margin-left: 50%;
 }
</style>
