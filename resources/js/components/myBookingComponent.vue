<template>
<div class="container">
    <h6>Booking History</h6>
    <table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Days</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="booking in bookings">
      <th scope="row">{{booking.total_nights}}</th>
      <td>{{booking.start_date}}</td>
      <td>{{booking.end_date}}</td>
      <td>
        <a type="button" id="show-modal" @click="showModal=true; setVal(booking.id, booking.start_date,
        booking.end_date,booking.customer_name, booking.customer_email,booking.phone
        )"  data-toggle="modal" data-target="#viewMine"
          class="btn btn-primary btn-sm">View
        </a>
      </td>
    </tr>
  </tbody>
</table>
<div class="modal fade" id="viewMine" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><a href="#">Booking Details</a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center">Dear {{name}} below is your booking details.
          <p> use the calendar arrow to scroll to your date</p></p>
        <p class="text-center">Your date is {{range.start}} to {{range.end}}</p>
        <p>Email: {{email}}</p>
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
    return{
      range: {},
      date: null,
      name:'',
      email:"",
      phone:"",
      bookings:[],
      booking:{

      }
    }
  },
  mounted(){
    this.getMyBookings(),
    console.log(this.$userId)
  },
  methods:{
    getMyBookings(){
      var myid = this.$userId
      let my_url= `api/mybookings/${myid}`
      fetch(my_url).then(response=>response.json())
      .then(response=>{
        console.log(response)
        this.bookings= response
      })
    },
    setVal(id, start,end,name,email,phone){
      this.start=start;
      this.end= end;
      this.name=name;
      this.email=email
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
