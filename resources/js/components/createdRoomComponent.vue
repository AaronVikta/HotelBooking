<template>
  <div class="container mt-4">
    <h5 class="text-success text-center">{{msg}}</h5>
    <h5 class="text-center">List of Rooms</h5>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Room Name</th>
          <!-- <th scope="col">Room Type</th> -->
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="room,key in rooms">
          <td class="bizname">{{room.room_name}}</td>
          <!-- <td>{{room.room_type}}</td> -->
          <!-- <td>{{room.room_name}}</td> -->
          <td><a type="button" id="show-modal" @click="showModal=true;
            setVal(room.id, room.room_type, room.room_name)"
            class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editroom">Edit
          </a></td>
          <td><a type="button" class="btn btn-danger btn-sm" @click="deteleRoom(room.id, key)"> Delete</a></td>
        </tr>
      </tbody>
    </table>
    <div v-if="showModal">

    </div>
    <div v-if="showModal">
      <div class="modal fade" id="editroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <div class="" slot="body">
                  <input type="text" name="" class="form-control mt-1" :value="this.room_name" id="name">
                  <input type="text" name="" class="form-control" :value="this.room_type" id="type">
                  <input type="hidden" name="" class="form-control" :value="this.id" id="id">
                  <button v-on:click.prevent @click="showModal=false"
                  data-dismiss="modal" class="mt-1 btn btn-outline-danger btn-sm" >Cancel</button>
                  <button v-on:click.prevent class="mt-1 btn btn-outline-success btn-sm" data-dismiss="modal" @click="updateRoom()">Update</button>
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
    <nav>
    <ul class="pagination">
      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
      <a href="#" class="page-link" @click="getRooms(pagination.prev_page_url)"> Prev</a>
      </li>
      <li class="page-item disabled">
        <a class="page-link text-dark" href="#">
        Page {{pagination.current_page}} of {{pagination.last_page}}
        </a>
      </li>
      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
      <a href="#" class="page-link" @click="getRooms(pagination.next_page_url)"> next</a>
      </li>
    </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data(){
      return {
        rooms:[],
        room:'',
        id:"",
        msg:"",
        room_type:'',
        room_name:'',
        showModal:false,
        pagination:{

        }
      }
  },
  mounted(){
    console.log('your room list is mounted'),
    this.getRooms(),
    this.setVal()
  },
  methods:{
  getRooms(page_url) {
    let vm = this;
    page_url = page_url || 'api/lists'
        fetch(page_url).then(res => res.json()).then(res => {
        this.rooms = res.data;
        vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
      },
      makePagination(meta, links){
        let pagination = {
        current_page :meta.current_page,
        last_page: meta.last_page,
        next_page: meta.next_page,
        next_page_url: links.next,
        prev_page_url: links.prev
        };
        this.pagination = pagination;
      },
      setVal(id, room_type, room_name){
        this.id= id
        this.room_name=room_name
        this.room_type=room_type
      },
      updateRoom(){
        var id = document.getElementById('id').value
        var type = document.getElementById('type').value
        var name= document.getElementById('name').value
        console.log(type);
        axios.put(`api/rooms/${id}`,{
          type :type,
          name:name
        })
        .then(res =>{
          console.log(res)
          this.showModal =false
          this.msg= "Room is Successfully Updated"
          this.getRooms()
        })
      },
      deteleRoom(id,key){
        if (confirm('Are you sure you want to delete')){
          axios.delete(`api/rooms/${id}`)
          .then(response =>{
            console.log(response)
            // remove the room type with a given key binding
            this.rooms.splice(key, 1)
            this.msg ="Deleted"
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
.bizname{
  text-transform: capitalize;
}
</style>
