<template>
  <div class="container">
    <h3 class="text-center">Price List Manager</h3>
      <div class="col-md-10 offset-md-1">
        <form v-on:submit.prevent>
        <div class="form-group row">

          <label for="inputEmail3" class="col-sm-2 col-form-label text-center">Choose Room Type:</label>
          <div class="col-sm-10">
            <select class="" name="" class="form-control no-borders" v-model="room">
              <option value="">Select Room Type</option>
              <option v-for="type in types" :value="type.type">{{type.type}}</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Set Price</label>
          <div class="col-sm-10">
            <input type="number" name="" value="" v-model="price" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 offset-md-2">
            <button @click="setPrice()" class="btn btn-primary form-control no-borders" :disabled="!isvalidForm">Set Price</button>
          </div>
        </div>
      </form>
      </div>
      <span class="jsutify-content-center"><h4 class="text-center">{{msg}}</h4></span>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Room Type</th>
            <th scope="col">Price</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="price,key in prices">
            <td class="bizname">{{price.room_type}}</td>
            <td>${{price.price}}</td>
            <!-- <td>{{room.room_name}}</td> -->
            <td><a type="button" id="show-modal" @click="showModal=true;
              setVal(price.id, price.room_type, price.price)"
              class="btn btn-primary btn-sm">Edit
            </a></td>
            <td><a type="button" class="btn btn-danger btn-sm" @click="detelePrice(price.id, key)"> Delete</a></td>
          </tr>
        </tbody>
      </table>
      <div class="mt-3">
        <div v-if="showModal">
          <form v-on:submit.prevent>
            <div class="" slot="header">
              <input disabled type="text" name="" class="form-control" :value="this.room_type" id="room_type">
              <input type="text" name="" class="form-control" :value="this.price" id="price">
              <input type="hidden" name="" class="form-control" :value="this.id" id="id">
              <a type="button" v-on:click.prevent @click="showModal=false" class="mt-1 btn btn-outline-danger btn-sm" >Cancel</a>
              <a type="button" v-on:click.prevent class="mt-1 btn btn-outline-success btn-sm" @click="updatePrice()">Update</a>
            </div>
          </form>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      type:"",
      room:"",
      price:'',
      rooms:[],
      types:[],
      prices:[],
      msg:'',
      showModal:false
    }
  },
  mounted(){
    this.getTypes(),
    this.getPrices()
  },
  computed:
  {
    isvalidForm(){
      return this.price&& this.room
    }
  },
  methods:{
    getTypes(){
      // get the endpoint we are targeting
      let url =url||'api/types'
      fetch(url).then(response=>response.json())
      .then(response =>{
        // match the types object of vue instance with the response data
        this.types = response.data
      }).catch(err=> console.log(err))
    },
    getPrices(){
      let price_url= price_url||'api/prices'
      fetch(price_url).then(response=>response.json())
      .then(res =>{
        this.prices= res.data
      })
    },
    setPrice(){
      axios.post('api/prices',{
       type:this.room,
        price:this.price
      }).then(res=>{
        this.getPrices()
        this.msg="Product Added Successfully"
        console.log(this.prices)
      })
    },
    setVal(id, room_type,price){
      this.id= id;
      this.room_type=room_type;
      this.price= price
    },
    updatePrice(){
      var id = document.getElementById('id').value
      var price = document.getElementById('price').value
      axios.put(`api/prices/${id}`,{
        price :price
      })
      .then(res =>{
        console.log(res)
        this.showModal =false
        this.getTypes()
        this.getPrices()
      })
    },
    detelePrice(id,key){
      if (confirm('Are you sure you want to delete')){
        axios.delete(`api/prices/${id}`)
        .then(response =>{
          console.log(response)
          // remove the room type with a given key binding
          this.prices.splice(key, 1)
        })
        .catch(err=>{
          console.log(err)
        })
      }
      else{
        console.log('thanks for not deleting me')
      }
    }
  }
}
</script>

<style lang="css" scoped>
</style>
