<template>
  <a class="dropdown-item"  role="button" :href="producturl" @click="markread"> {{this.unread['data'].user.name}} posted a new product
   <br>{{this.unread['data'].product.name}}</a>
</template>

<script>
export default {
  name: "NotificationItem",
  props:['unread'],
  data(){
    return {
      producturl:"",
      id:""
    }
  },

  mounted() {
    console.log(this.unread)
    this.producturl="/shop/"+this.unread['data'].product.slug
    this.id=this.unread['id']
  },
  methods :{
    markread(){
      axios.get('/markasread/'+this.unread.id);
      console.log(this.unread.id);
    }

  }


}
</script>

<style scoped>

</style>