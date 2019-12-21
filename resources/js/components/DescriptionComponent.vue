<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <div class="text-center">
                    <!-- <div class="card-header">Example Component</div> -->

                    <div class="mt-2 mb-1">
                        <h2 class="appname">Awesome Hotel</h2>
                        <p> Welcome to Awesome Hotel, Your marvelous Home away from home</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
  .appname{
    font-size:40px;
    font-family: monospace;
  }
</style>
