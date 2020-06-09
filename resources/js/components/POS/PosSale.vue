<template>
    <div class="content  pt-3">
<!--        <form>-->
            <div class="col-lg-12 ">
                <button class=" btn btn-default cs-btn" @click="sendData()" :disabled="isDisable()">Done</button>
            </div>
            <div class="left-div col-lg-5 bg-light  float-left mt-5 ">
                <div>
                    <span class="text-danger" v-if="errorMessage">{{errorMessage}}</span>
                </div>
                <input type="hidden" v-model="item_id" name="item_id" >

                <div class="">
                    <label class="w-25">Name</label>
                    <input type="text"  autocomplete="off" name="name"  v-model="search" v-on:keyup="getItemName" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-6"  @focus="modal=true">
                </div>
                <div class="panel-footer " v-if="results.length && modal">
                    <ul class="list-group ">
                        <li class="list-group-item col-md-8" v-for="result in results" @click="selectItem(result.id,result.name,result.price,result.qty)">{{ result.name }}</li>
                    </ul>
                </div>
                <span class="text-danger" id="name_error">
                                </span>
                <div class="mb-3 mt-3">
                    <label class="w-25">Qty</label>
                    <input type="number" v-model="qty"  min="0" name="qty" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-6" @input="checkQty()">
                </div>
                <span class="text-danger" id="qty_error">
                                </span>
                <div class="m-button pt-3 ">
<!--                    <button @click="addItem">Add</button>-->
                    <button   class="btn btn-nb-mount2 fontsize-mount22 px-3 col-md-4   cs-btn"  @click="addItem()" :disabled="isDisable()">Add To Cart</button>
                </div>
<!--                <ul  >-->
<!--                    <li v-for="(t,index) in item_list" >-->
<!--                        {{t.name}} <button v-on:click="item_list.splice(index,1)">remove</button>-->
<!--                    </li>-->
<!--                </ul>-->
            </div>

            <div class="col-lg-6 bg-light h-75 float-right mt-5">
                <p ><b>Total:</b>
                    <i v-if="total">
                        {{total}}

                    </i>
                    <i v-else="total">
                        0
                    </i>
                </p>
<!--                <p v-else="total"><b>Total:</b>0</p>-->
                <div class="table-responsive" >
                    <table class="table">
                        <thead>
<!--                        <tr ><p style="background-color: gray">Cart</p></tr>-->
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Action</th>
<!--                            <th>Name</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <tr  v-for="(t,index) in item_list" >
<!--                            <li >-->
                            <td>
                                {{t.name}}
                            </td>
                            <td>
                                <span class="badge"> {{t.qty}}
                                </span>
                            </td>
                            <td>{{t.price}}</td>

                            <td>
                                <button v-on:click="deleteItem(item_list,index)" class="float-right border-0">x</button>
                            </td>
<!--                            </li>-->
                        </tr>
                        </tbody>
                    </table>
                </div>
<!--                <div>-->
<!--                    <ul >-->
<!--                        <li v-for="(t,index) in item_list"  >-->
<!--                            {{t.name}} <span class="badge"> {{t.qty}}</span><button v-on:click="item_list.splice(index,1)" class="float-right border-0">x</button>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->

            </div>
<!--        </form>-->
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        // mounted() {
        //     console.log('Component mounted.')
        // }
        data:function () {
            return{
                search:'',
                item_id:'',
                results:[],
                old_qty:'',
                qty:'',
                price:'',
                modal:false,
                item_list:[],
                total:'',
                errorMessage:'',
                error:true,
            }
        },
        mounted() {
            // console.log(this.item_list);
            // if(this.item_list.length<=0){
            //     console.log('error');
            // }
        },
        methods:{
            getItemName(){
                this.results=[];
                if(this.search.length>0){
                    axios.get('/sale/get_item_name',{
                        params:{
                            search:this.search
                        }
                    }).then(response=>{
                        // console.log(response.data);
                        this.results=response.data.items;
                    })
                }
            },
            selectItem($id,item_name,price,old){
                this.modal=false;
                this.search=item_name;
                this.item_id=$id;
                this.price=price;
                this.old_qty=old;
                // console.log(this);
            },
            addItem(){
                    this.item_list.push({
                        id:this.item_id,
                        name:this.search,
                        qty:this.qty,
                        price:this.price,
                    });
                this.getTotal(this.item_list);
                    this.modal=false;
                    this.search='';
                    this.qty='';
            },
            deleteItem(items,index){
                items.splice(index,1);
                this.getTotal(items);
            },
            getTotal(items){
                var total=0;
                $.each(items,function(key,value){
                    total+=parseInt(value.qty,10) * value.price;
                });
                this.total=total;

            },
            sendData(){
                // console.log(this.item_list);
                var items=this.item_list;
                var total=this.total;
                axios.post('/sale/create', {
                        items:items,
                    total:total,
                }).then(response=>{
                    window.location.replace('/sale/sale_record');
                });
            },
            checkQty(){
                var old=parseInt(this.old_qty);
                // console.log(this.item_list);
                if(old<this.qty){
                    this.errorMessage='Not Enough Quantity ';
                    this.error=true;
                }else{
                    this.errorMessage='';
                    this.error=false;

                }
            },
            isDisable(){
                return this.error==true;
            }
        },
        created() {
            console.log(this.item_list);
            // if(this.item_list.length<=0){
            //     console.log('error');
            // }else{
            //     console.log('s');
            // }
        }

    }
</script>
