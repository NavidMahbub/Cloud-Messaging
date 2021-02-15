<template>
<div class="messaging">
    {{category_list}}
    category_list ta  er na kno jani!!!
        <div class="inbox_msg">
            <div class="inbox_people">
            <div class="headind_srch">  
                <div class="row">
                    <div  class="col-md-4">  
                       <select class="form-control">
                            <option v-for="(i,k) in category_list" :key="k"> {{i.category_name}}</option>    
                        </select>
                    </div>

                    <div style="padding: 0" class="col-md-6">
                        <b-form-input type="text" class="" name="Title"  v-model="newCategory" placeholder="Create New Topic"></b-form-input>
                    </div>
                    <div style="padding: 0" class="col-md-2">
                        <button v-if="newCategory!=''" @click="addNewTopic" type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> </button>
                        <button v-else type="button" class="disabled-topic-btn"><i class="fa fa-plus" aria-hidden="true"></i> </button>
                    </div>
                </div>
            </div>
            <div class="inbox_chat" >
                <div v-for="(i,k) in topic_list" :key="k">
                    <div v-bind:class="{chat_list:true,  active_chat: activeChat===i.id }"  @click="setActiveId(i.id)">
                        <div class="chat_people" >
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5>{{i.user_name}} <span class="chat_date">{{i.created_at_ago}} <br> <br>  <i style="margin-left:30px;" @click="deleteTopic(i.id)" class="fa fa-trash"></i></span> </h5>
                            <p>{{i.body}}</p>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
            </div>
            <div class="mesgs">
            <div class="msg_history">
                <div  v-for="(i,k) in message_list" :key="k">

                    <div v-if=" i.user_id===loged_user " class="outgoing_msg">
                        <div class="sent_msg">
                            <p>{{i.body}}</p>
                            <span class="time_date"> {{i.created_at}} </span>
                        </div>
                    </div>
                    
                    <div v-else class="incoming_msg"> 
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                            <p>{{i.body}}</p>
                            <span class="time_date"> {{i.created_at}}</span></div>
                        </div>
                    </div>
             </div>
            </div>
            <div class="type_msg">
                <div class="input_msg_write">
                <input v-model="messageToBeSent"  v-on:keyup.enter="sendMessage()" type="text" class="write_msg" placeholder="Type a message" />
                <button v-if="messageToBeSent!=''" @click=sendMessage() class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                <button v-if="messageToBeSent===''" class="msg_send_btn_disabled" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                </div>
            </div>
            </div>
        </div>
        </div>
</template>

<script>
import Vue from 'vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate)
import pagination from 'laravel-vue-pagination'
import { mapState,mapGetters } from "vuex"
import { ADD_MESSAGES,FETCH_MESSAGES,FETCH_TOPICS,FETCH_CATEGORY} from "@/store/action.type"

    export default {
    data() {
        return {
        messageToBeSent: '',
        activeChat:1,
        newCategory:'',    
        };
    },
    computed:{
            ...mapGetters(['message_list','topic_list','category_list','loged_user'])
    },

    mounted() {

        this.fetchTopics();
        this.fetchCategory();
        this.$store.dispatch("FETCH_LOGED_IN_USER").then(response => {
        })
        .catch(error => {
        });

       
    },
    
    methods: {

        sendMessage(){

            let payload={
                id:null,
                body:this.messageToBeSent,
                user_id:null,
                parent_id:this.activeChat
            }
            this.addMessages(payload);
            this.fetchMessages(this.activeChat);
            this.messageToBeSent=''
        },

        setActiveId(id){
            this.activeChat=id
           this.fetchMessages(this.activeChat);    
        },
        deleteTopic(id){

            this.$store.dispatch("DELETE_TOPICS",id).then(response => {
                })
            .catch(error => {
            });

            this.fetchTopics();
        },

        addNewTopic(){
                let pay={
                id:null,
                body:this.newCategory,
                parent_id:null,
                user_id:null
                }
               
                this.addMessages(pay);
                this.fetchTopics();
                this.newCategory=''   
        },

        fetchMessages(id){
            this.$store.dispatch("FETCH_MESSAGES",id).then(response => {
            })
            .catch(error => {
            });
        },
        fetchTopics(){
            this.$store.dispatch("FETCH_TOPICS").then(response => {
            })
            .catch(error => {
            });
        },
        fetchCategory(){
            this.$store.dispatch("FETCH_CATEGORY").then(response => {
                })
            .catch(error => {
            })
        },
        addMessages(pay){
            this.$store.dispatch('ADD_MESSAGES',pay).then(response=>{           
                              
            }).catch(error=>{
                  
            });
        }


        
    },
    };
</script>


<style>
    .container {
    max-width: 1170px;
    margin: auto;
    }
    img {
    max-width: 100%;
    }
    .inbox_people {
    background: #f8f8f8 none repeat scroll 0 0;
    float: left;
    overflow: hidden;
    width: 40%;
    border-right: 1px solid #c4c4c4;
    }
    .inbox_msg {
    border: 1px solid #c4c4c4;
    clear: both;
    overflow: hidden;
    }
    .top_spac {
    margin: 20px 0 0;
    }

    .recent_heading {
    float: left;
    width: 40%;
    text-transform: none;
    margin-top: 6px;
    }
    .srch_bar {
    display: inline-block;
    text-align: right;
    width: 60%;
    }
    .headind_srch {
    padding: 10px 29px 10px 20px;
    overflow: hidden;
    border-bottom: 1px solid #c4c4c4;
    }

    .recent_heading h4 {
    color: #05728f;
    font-size: 21px;
    margin: auto;
    }
    .srch_bar input {
    border: 1px solid #cdcdcd;
    border-width: 0 0 1px 0;
    width: 80%;
    padding: 2px 0 4px 6px;
    background: none;
    }
    .srch_bar .input-group-addon button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    padding: 0;
    color: #707070;
    font-size: 18px;
    }
    .srch_bar .input-group-addon {
    margin: 0 0 0 -27px;
    }

    .chat_ib h5 {
    font-size: 15px;
    text-transform: none;
    color: #464646;
    margin: 0 0 8px 0;
    }
    .chat_ib h5 span {
    font-size: 13px;
    text-transform: none;
    float: right;
    }
    .chat_ib p {
    font-size: 14px;
    text-transform: none;
    color: #989898;
    margin: auto;
    }
    .chat_img {
    float: left;
    width: 11%;
    }
    .chat_ib {
    float: left;
    padding: 0 0 0 15px;
    width: 88%;
    }

    .chat_people {
    overflow: hidden;
    clear: both;
    }
    .chat_list {
    border-bottom: 1px solid #c4c4c4;
    margin: 0;
    padding: 18px 16px 10px;
    }
    .inbox_chat {
    height: 480px;
    overflow-y: scroll;
    }

    .active_chat {
    background:#cdcfd4;
    }

    .incoming_msg_img {
    display: inline-block;
    width: 6%;
    }
    .received_msg {
    display: inline-block;
    padding: 0 0 0 10px;
    vertical-align: top;
    width: 92%;
    }
    .received_withd_msg p {
    background: #d9d9d9 none repeat scroll 0 0;
    border-radius: 20px;
    text-transform: none;
    color: #646464;
    font-size: 14px;
    margin: 0;
    padding: 5px 10px 5px 12px;
    width: 100%;
    }
    .time_date {
    color: #747474;
    display: block;
    text-transform: none;
    font-size: 12px;
    margin: 8px 0 0;
    }
    .received_withd_msg {
    width: 57%;
    }
    .mesgs {
    float: left;
    padding: 30px 15px 0 25px;
    width: 60%;
    }

    .sent_msg p {
    background: #05728f none repeat scroll 0 0;
    border-radius: 20px;
    text-transform: none;
    font-size: 14px;
    margin: 0;
    color: #fff;
    padding: 5px 10px 5px 12px;
    width: 100%;
    }
    .outgoing_msg {
    overflow: hidden;
    margin: 26px 0 26px;
    }
    .sent_msg {
    float: right;
    width: 46%;
    
    }
    .input_msg_write input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    color: #4c4c4c;
    font-size: 15px;
    min-height: 48px;
    width: 100%;
    }

    .type_msg {
    border-top: 1px solid #c4c4c4;
    position: relative;
    }
    .msg_send_btn {
    background: #05728f none repeat scroll 0 0;
    border: medium none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    height: 33px;
    position: absolute;
    right: 0;
    top: 11px;
    width: 33px;
    }
      .msg_send_btn_disabled {
    background: #828281 none repeat scroll 0 0;
    border: medium none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    height: 33px;
    position: absolute;
    right: 0;
    top: 11px;
    width: 33px;
    }
    .disabled-topic-btn{
        background: #828281 none repeat scroll 0 0;
        position: absolute;
        font-size: 17px;
    }
    .messaging {
    padding: 0 0 50px 0;
    }
    .msg_history {
    height: 450px;
    overflow-y: auto;
    }
</style>

