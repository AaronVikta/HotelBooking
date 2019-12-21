<template>
    <div class="container">
       <h5 class="text-center mt-5">List of Room Types</h5>
      <div class="row">
        <div class="col-md-12 ">
          <table class="table">
            <thead>
              <tr>
                <!-- <th scope="col">ID</th> -->
                <th scope="col">Type Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="type,key in types">
                <!-- <td>{{type.id}}</td> -->
                <td>{{type.type}}</td>
                <td>
                    <!-- Button trigger modal -->
                <a type="button" id="show-modal"
                data-toggle="modal" data-target="#edit"
                 @click="showModal=true; setVal(type.id, type.type)"
                  class="btn btn-primary btn-sm">Edit
                </a>
                </td>
                <td>
                <a type="button" @click="deteleType(type.id, key)" class="btn btn-danger btn-sm">
                   Delete</a> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div v-if="showModal">
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><a href="#">Edit Room Type</a></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form v-on:submit.prevent>
                  <div class="" slot="header">
                    <input type="text" name="" class="form-control" :value="this.type" id="room_type">
                    <input type="hidden" name="" class="form-control" :value="this.id" id="id">
                    <a type="button" v-on:click.prevent @click="showModal=false"
                    data-dismiss="modal" class="mt-1 btn btn-outline-danger btn-sm" >Cancel</a>
                    <a type="button" v-on:click.prevent class="mt-1 btn btn-outline-success
                    btn-sm" @click="updateType()" data-dismiss="modal">Update</a>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
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
