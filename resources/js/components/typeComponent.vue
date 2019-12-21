<template>
    <div class="container">
      <div class="mt-4 col-md-10 offset-md-1">
        <h2 class="text-center">Create Room Type</h2>
        <form v-on:submit.prevent>
          <input type="text" name="room_type" value="" v-model="room_type" class="form-control mb-1">
          <input type="submit" name="button" value="Create a Type"
           class="btn btn-outline-success form-control"
           v-bind:disabled="!isvalidForm" @click="createType">
        </form>
      </div>
       <h4 class="text-center mt-5">List of Created Room Types</h4>
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Type Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="type,key in types">
                <td>{{type.id}}</td>
                <td>{{type.type}}</td>
                <td>
                    <!-- Button trigger modal -->
                <button id="show-modal" @click="showModal=true; setVal(type.id, type.type)"
                  class="btn btn-info">Edit
                </button>
                </td>
                <td>
                <button @click="deteleType(type.id, key)"> Delete</button> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div v-if="showModal">
        <form v-on:submit.prevent>
          <div class="" slot="header">
            <input type="text" name="" class="form-control" :value="this.type" id="room_type">
            <input type="hidden" name="" class="form-control" :value="this.id" id="id">
            <button v-on:click.prevent @click="showModal=false" class="mt-1 btn btn-outline-danger btn-sm" >Cancel</button>
            <button v-on:click.prevent class="mt-1 btn btn-outline-success btn-sm" @click="updateType()">Update</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      data(){
        return{
              types:[],
              room_type:'',
              id:'',
              type:'',
              showModal:false
          }
          },
        mounted() {
            console.log('Component mounted.'),
            this.getTypes(),
            this.setVal()
        },
        computed:
        {
          isvalidForm(){
            return this.room_type
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
          createType(){
            axios.post('api/types',{
              room_type:this.room_type
            })
            .then(res=> {
              console.log(res)
              this.types.push(res.data)
            }).catch(err=>{
              console.log(err);
            })
          },
          // the func declaration to enable v-if toggle
          editType(){

          },
          setVal(id, type){
            this.id= id;
            this.type=type;
          },
          updateType(){
            var id = document.getElementById('id').value
            var room_type = document.getElementById('room_type').value
            axios.put(`api/types/${id}`,{
              type :room_type
            })
            .then(res =>{
              console.log(res)
              this.showModal =false
              this.getTypes()
            })
          },
          deteleType(id,key){
            if (confirm('Are you sure you want to delete')){
              axios.delete(`api/types/${id}`)
              .then(response =>{
                console.log(response)
                // remove the room type with a given key binding
                this.types.splice(key, 1)
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
