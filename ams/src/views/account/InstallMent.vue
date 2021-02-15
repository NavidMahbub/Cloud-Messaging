<template>
    <div class="card">
        <div class="container-fluid">
            <form>
                <div  class="form-group row">
                    <div style="height:20px;" class="col-sm-12"></div>
                    <div class="col-sm-3">
                        <select id="inputState" class="form-control" >
                            <option value="" >Select Project</option>
                            <option value="1">Model Town</option>
                            <option value="2">King City</option>
                            <option value="3">Royal City</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select id="inputState" class="form-control" >
                            <option value="" >Select Plot</option>
                            <option value="1">003</option>
                            <option value="2">004</option>
                            <option value="3">005</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select id="inputState" class="form-control" >
                            <option value="" >Select Client</option>
                            <option value="1">Rahim</option>
                            <option value="2">Karim</option>
                            <option value="3">Shofiq</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button style="width:100%" class="btn btn-outline-success" >Search</button>
                    </div>
                </div>
            </form>
            <table class="table table-sm ">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Flat/Plot No</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Totall Installment</th>
                    <th scope="col">Payed Installment</th>
                    <th scope="col">Unpayed Installment</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(payment,index) in payments" :key="index">
                        <th scope="row">{{index + 1}}</th>
                        <td>{{payment.project_name}}</td>
                        <td>{{parseInt(payment.plot_no)+1}}</td>
                        <td>{{payment.client_name}}</td>
                        <td>5</td>
                        <td>3</td>
                        <td>2</td>
                        <td>
                            <button class="btn btn-sm btn-success" @click="largeModal = true" ><i class="fa fa-dollar"> Pay</i></button>
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
            <b-modal title="Pay Installment" hide-footer size="lg" v-model="largeModal" @ok="largeModal = false">
                <form>
                    <div >
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Installment No</label>
                            <div class="col-sm-10">
                                <select id="inputState" class="form-control" >
                                    <option value="" >Select Installment No</option>
                                    <option value="2">Four</option>
                                    <option value="3">Five</option>
                                </select>
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="inputPassword3" value="3000">
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
            <b-modal title="Flat Details" hide-footer size="lg" v-model="largeModal2" @ok="largeModal2 = false">
                <form>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <p><b>Project Name:</b> Ronstring</p>
                            <p><b>Flat No:</b> 12</p>
                            <p><b>Flat type:</b> Duplex</p>
                            <p><b>Size:</b> 5 dcml</p>
                            <p><b>Price:</b> 10000 Tk</p>
                            <p><b>Deatails:</b> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                        </div>
                    </div>
                </form>
            </b-modal>
            <b-modal title="Delete Advance Payment" size="sm" v-model="smallModal" @ok="smallModal = false">
                <b><p style="color:red">Are you sure to delete</p></b>
            </b-modal>
        </div>
    </div>
</template>

<script>
import data from './advance_payment'
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
