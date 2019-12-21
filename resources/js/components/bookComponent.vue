<template>
  <div class="mt-5">
    <h5 class="text-center">List of Bookings</h5>
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Room ID</th>
              <th scope="col">Customer Name</th>
              <!-- <th scope="col">Customer Email</th> -->
              <!-- <th></th> -->
              <th scope="col">Action</th>
              <!-- <th scope="col">Delete</th> -->
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking,key in bookings">
              <td>{{booking.room_id}}</td>
              <td>{{booking.customer_name}}</td>
                <!-- <td>{{booking.customer_email}}</td> -->
                <!-- <td></td> -->
              <td>
                  <!-- Button trigger modal -->
              <a type="button" id="show-modal" @click="showModal=true; setVal(booking.id, booking.start_date,
              booking.end_date)"  data-toggle="modal" data-target="#exampleModalCenter"
                class="btn btn-primary btn-sm">View
              </a>
              </td>
              <!-- <td>
              <a type="button" @click="deteleType(type.id, key)" class="btn btn-danger btn-sm">
                 Delete</a> </td> -->
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><a href="#">Booking Details</a></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="text-center">Your date is {{range.start}} to {{range.end}}</p>
            <v-range-selector selected
              :start-date.sync="range.start"
              :end-date.sync="range.end"
            />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style src="vuelendar/scss/vuelendar.scss" lang="scss"></style>
<script>
import VRangeSelector from 'vuelendar/components/vl-range-selector';
import VDaySelector from 'vuelendar/components/vl-day-selector';
export default {
    components: {
      VRangeSelector,
      VDaySelector
    },
  data(){
    return {
      range: {},
      date: null,
      showModal:false,
      bookings:{
      }
    }
  },
  mounted(){
    this.getBookings(),
     console.log(this.$userId)
  },
  methods:{
    getBookings(){
      let url=url||'api/bookings'
      fetch(url).then(response=>response.json())
      .then(response=>{
        console.log('bookings fetched')
        this.bookings =response.data
      })
    },
    setVal(id, start,end){
      this.start=start;
      this.end= end;
    var ranges={
        'start':start,
        'end':end
      };
      this.range=ranges
      console.log(this.range);
    }
  }
}
</script>

<style lang="css" scoped>
</style>
