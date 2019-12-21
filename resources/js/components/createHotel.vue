<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 md-offset-4">
                <div class="text-center">
                  <form  enctype="multi" v-on:submit.prevent>
                    <input type="text" name="" v-model="hotel_name" placeholder="Hotel Name"
                     class="form-control no-borders mb-2">
                    <input type="text" name="" v-model="address" placeholder="Hotel Address"
                     class="form-control no-borders mb-2">
                    <input type="text" name="" v-model="city" placeholder="Hotel City"
                     class="form-control no-borders mb-2">
                    <input type="text" name="" placeholder="Hotel State" v-model="state"
                    class="form-control no-borders mb-2">
                    <input type="text" name=""  placeholder="Country Location" v-model="country"
                    class="form-control no-borders mb-2">
                    <input type="text" name="" placeholder="Zip/Postal " v-model="zip"
                    class="form-control no-borders mb-2">
                    <input type="number" name="" placeholder="Phone" v-model="phone"
                    class="form-control no-borders mb-2">
                    <input type="text" name="" placeholder="Email" v-model="email"
                    class="form-control no-borders mb-2">
                    <input type="file" class="form-control no-borders mb-2" v-on:change="onFileChange">
                    <button name="" value="Create" class="form-control
                    no-borders btn btn-outline-success" v-bind:disabled="!isvalidLoginForm"
                     @click="createHotel()">
                    Add Hotel
                  </button>
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
              hotel_name:'',
              address:'',
              city:'',
              state:'',
              country:'',
              zip:'',
              phone:'',
              email:'',
              image:'',
            }
          },
        mounted() {
            console.log('Component mounted.')
        },
        computed:
        {
          isvalidLoginForm(){
            return this.emailIsValid()
            &&this.hotel_name&& this.address&&this.city
            &&this.country&&this.zip
          }
        },
        methods:{
          onFileChange(event){
          let files= event.target.files || event.dataTransfer.files
          if(!files.length)
          return
          this.createImage(files[0])
          },
          createImage(file){
            let reader = new FileReader()
            let vm = this;
            reader.onload= (e)=>{
              vm.image = e.target.result
            },
            reader.readAsDataURL(file)
          },
          createHotel(){
               
            axios.post('/api/hotels', {
              hotel_name: this.hotel_name,
              address: this.address,
              city:this.city,
              state:this.state,
              country:this.country,
              zip:this.zip,
              phone:this.phone,
              email:this.email,
              image:this.image
            }).then(res=>{
              console.log(res)
          }).catch(error =>{
            console.log(error)
          })
          },
        emailIsValid(email)
                {
                 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email))
                  {
                    return true
                  }
                    return false
                }
        }
    }
</script>
<style scoped>
  .no-borders{
    border-radius: 0px;
  }
</style>
