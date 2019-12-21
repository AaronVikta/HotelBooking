<template>
    <div class="container">
      <div class="row">
        <div v-for="room in rooms" class="col-md-3 mb-2 ">
          <div class="card controlImageHeight">
            <img :src="room.image" alt="rooms Image" class="card-image-top controlImageHeight">
          </div>
          <div class="card-body sizehandler" style="border:solid 1px #f0f0f0;">
            <div class="row">
              <div class="col-md-12" style="border-bottom:1px solid #999">
                <h6 class="text-center biznam" v-for=" type in types" >
                  <span v-if="type.type==room.room_type">{{room.room_name}}
                  </span>
                </h6>
              </div>
              <div class="col-md-12 mt-1" v-for="hotel in hotels">
                <span> <span style="font-weight:bolder;">Address:</span> {{hotel.address}},</span>
                <span class="ml-1">{{hotel.city}},</span>
                <span>{{hotel.state}},</span>
                <span class="mr-1"> {{hotel.country}}.</span>
              </div>
              <div class="col-md-12 mt-1" v-for="hotel in hotels">
                <span class="mr-1">Contact: {{hotel.phone}}, </span>
                <span> {{hotel.email}}</span>
              </div>
            </div>
            <div class="col-md-12 mt-1">
              <a type="button" name="button"
              @click="showModal=true; getRoomDetail(room.id)" data-toggle="modal" data-target="#book"
               class="btn btn-outline-success float-right btn-sm no-borders" style="margin-right:-32">
              Book </a>
            </div>
        </div>
       </div>
     </div>
     <div class="">
       <h6 class=" text-center text-success"> {{msg}}</h6>
       <h6 class=" text-center text-danger">{{errormsg}}</h6>
     </div>
     <div class="" v-if="showModal">

     </div>
     <div v-if="showModal">
       <div class="modal no-borders fade" id="book" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title text-center" id="exampleModalLongTitle">
                 <a class="text-center" href="#">Make Booking</a></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <div class="" slot="body">
                 <div class="form-group row">

                   <label for="inputEmail3" class="col-sm-2 col-form-label">Selected Room:</label>
                   <div class="col-sm-10">
                     <input type="text" name="" disabled :value="space.room_name" class="form-control bizname">
                   </div>
                 </div>
                 <input type="hidden" name="" :value="space.id" id="room_id" class="form-control">
                 <input type="hidden" name="" :value="space_price" id="space_price" class="form-control">
                 <input type="hidden" id="space_type" value="space_type" class="form-control">
                 <div class="form-group row">
                   <label for="inputPassword3" class="col-sm-2 col-form-label">Price Per Night (USD)</label>
                   <div class="col-sm-10">
                     <input type="number" disabled name="" :value="space_price" class="form-control">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="inputPassword3" class="col-sm-2 col-form-label">Customer Email</label>
                   <div class="col-sm-10">
                     <input type="email" name="" id="customer_email" value="" class="form-control">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="inputPassword3" class="col-sm-2 col-form-label">Customer Name</label>
                   <div class="col-sm-10">
                     <input type="text" id="customer_name" value="" class="form-control" required>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="inputPassword3" class="col-sm-2 col-form-label">Start Date</label>
                   <div class="col-sm-10">
                     <input type="date" id="start_date" value="" class="form-control" required>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="inputPassword3" class="col-sm-2 col-form-label">End Date</label>
                   <div class="col-sm-10">
                     <input type="date" id="end_date" value="" class="form-control" required>
                   </div>
                 </div>

                 <div class="form-group row">
                   <div class="col-sm-10 offset-md-2">
                     <button type="submit" v-on:click.prevent
                     class="btn btn-primary form-control no-borders" data-dismiss="modal" @click="confirmBooking()">
                       Complete Booking</button>
                   </div>
                 </div>
               </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
           </div>
         </div>
       </div>
     </div>
      <nav aria-label="Page navigation example" style="margin-top:15px" class="float-right">
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
        return{
              rooms:[],
              msg:'',
              errormsg:"",
              showModal:false,
              types:[],
              range: {},
              date: null,
              hotels:[],
              end_date:'',
              start_date:'',
              room:{
                name:'',
              address:'',
              city:'',
              state:'',
              country:'',
              zip:'',
              phone:'',
              email:'',
              image:''
            },
            space:{

            },
            space_type:'',
            space_price:'',
            pagination:{

            }
            }
          },
        mounted() {
            console.log('Component mounted.'),
            this.getRooms(),
            this.getTypes(),
            this.getHotels(),
            this.findtype
        },
        computed:
        {
          findtype: function(){
            for(var type in this.types){
              console.log(`this is `)
            }
          }
        },
        components:{

        },
        methods:{

        getRooms(page_url) {
        let vm = this;
        page_url = page_url || 'api/rooms'
            fetch(page_url).then(res => res.json()).then(res => {
            this.rooms = res.data;
            vm.makePagination(res.meta, res.links);
            })
            .catch(err => console.log(err));
          },
          getTypes(){
            let url =url||'api/types'
            fetch(url).then(response=>response.json())
            .then(response =>{
              this.types = response.data
            })
          },
          setVal(space_type,space_price,space){
            console.log(this.space)
          },
          getHotels(){
            let hotelurl= hotelurl ||'api/hotels'
            fetch(hotelurl).then(response=>response.json())
            .then(response =>{
              this.hotels = response.data
              console.log(response.data)
            })
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
          getRoomDetail(id){
            let roomurl = roomurl||`api/rooms/${id}`
            fetch(roomurl).then(response=>response.json())
            .then(response=>{
              this.space = response.room
              this.space_type = response.type
              this.space_price=response.price
              console.log(this.space);
              this.setVal(this.space, this.space_type, this.space_price)
            })
          },
          confirmBooking(){
            var room_id= document.getElementById('room_id').value
            var start_date=document.getElementById('start_date').value
            var end_date= document.getElementById('end_date').value
            var customer_name= document.getElementById('customer_name').value
            var customer_email=document.getElementById('customer_email').value
            var stacticprice = document.getElementById('space_price').value;
            var first_night = new Date(start_date)
            var last_night= new Date(end_date)
            var date_range = Math.abs(first_night.getTime()- last_night.getTime())
            var diff_days = Math.ceil(date_range/(1000*60*60*24))
            var total_price= stacticprice*diff_days
            axios.post(`api/bookings`,{
              room_id:room_id,
              customer_email:customer_email,
              customer_name:customer_name,
              total_nights:diff_days,
              total_price:total_price,
              start_date:start_date,
              end_date:end_date
            }).then(res=>{
              console.log(res)
              this.showModal=false
              this.msg="Booking Successful"
            }).catch(err=>{
              console.log(err)
              this.errormsg="Booking Failed"
            })
            console.log(room_id);
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
    min-height: 200px;
    max-height: 200px;
  }
  .bizname{
    text-transform: capitalize;
  }
</style>
