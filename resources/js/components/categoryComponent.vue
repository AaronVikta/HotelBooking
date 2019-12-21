<template>
    <div class="container">
      <div class="mt-4">
        <h2 class="text-center">Create Room Capacity</h2>
        <form action="api/capacities" method="post">
          <input type="number" name="capacity" value="" v-model="capacity" class="form-control mb-1">
          <input type="submit" name="button" value="Create a Type"
           class="btn btn-outline-success form-control"
           v-bind:disabled="!isvalidForm">
        </form>
      </div>
       <h4 class="text-center mt-5">List of Created Room Types</h4>
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Max Capacity</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="capacity,key in capacities">
                <td>{{capacity.id}}</td>
                <td>{{capacity.capacity}}</td>
                <td><button id="show-modal" @click="showModal=true; setVal(capacity.id, capacity.capacity)"
                  class="btn btn-info">Edit
                </button></td>
                <td>
                <button @click="deteleCapacity(capacity.id, key)"> Delete</button> </td>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div v-if="showModal">
        <form v-on:submit.prevent>
          <div class="" slot="body">
            <input type="text" name="" class="form-control" :value="this.capacity" id="max_capacity">
            <input type="hidden" name="" class="form-control" :value="this.id" id="id">
            <button v-on:click.prevent @click="showModal=false" class="mt-1 btn btn-outline-danger btn-sm" >Cancel</button>
            <button v-on:click.prevent class="mt-1 btn btn-outline-success btn-sm" @click="updateCapacity()">Update</button>
          </div>
        </form>
      </div>
    </div>
</template>

<script>
    export default {
      data(){
        return{
              visible:false,
              types:[],
              capacities:[],
              capacity:"",
              showModal:false
          }
          },
        mounted() {
            console.log('Component mounted.'),
            this.getCapacities()
        },
        computed:
        {
          isvalidForm(){
            return this.validcapacity()
          }
        },
        methods:{
          getCapacities(){
            let url =url||'api/capacities'
            fetch(url).then(response=>response.json())
            .then(response =>{
              this.capacities = response.data
            }).catch(err=> console.log(err))
          },
          validcapacity(capacity){
            if(this.capacity >0){
              return true
            }
            else{
              return false
            }
          },
          editCapacity(){

          },
          setVal(id, type){
            this.id= id;
            this.capacity=capacity;
          },
          updateCapacity(){
            var id = document.getElementById('id').value
            var max_capacity = document.getElementById('max_capacity').value
            axios.put(`api/capacities/${id}`,{
              capacity :max_capacity
            })
            .then(res =>{
              console.log(res)
              this.showModal =false
              this.getCapacities()
            })
          },
          // delete a row in the Capacity database
          deteleCapacity(id,key){
            if (confirm('Are you sure you want to delete')){
              axios.delete(`api/capacities/${id}`)
              .then(response =>{
                console.log(response)
                // remove the room type with a given key binding
                this.capacities.splice(key, 1)
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
<style scoped>
  .no-borders{
    border-radius: 0px;
  }
  .sizehandler{
    height: 212px;
    border: 1px solid gray;
  }
  .image-control{
    height: 100px;
  }
  .controlImageHeight{
    border-radius:0px;
    min-height: 150px;
    max-height: 150px;
  }
  .bizname{
    text-transform: capitalize;
  }
</style>
