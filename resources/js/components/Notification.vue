<template>
  <li class="nav-item dropdown " id="markasread" >

    <a class="dropdown-toggle"  href="#" id="notifications"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="glyphicon glyphicon-globe">notifications</span>
      <span class="badge">{{ this.unreadNotifications.length }}</span>

    </a>
    <div class="dropdown-menu"  style="background-color: #1a1f21"  aria-labelledby="navbarDropdown" >
      <notification-item v-for="unread in unreadNotifications" :unread="unread"></notification-item>


    </div>
  </li>
</template>


<script>
import NotificationItem from "./NotificationItem";
export default {
  props:['unreads','userid'],
  components:{NotificationItem},
  data(){
    return {
      unreadNotifications:this.unreads
    }
  },
  mounted() {
    console.log('mounted')
    Echo.private('App.User.' + this.userid)
        .notification((notification) => {
          console.log(notification);
          let newUnreadNotifications={data:{user:notification.user,product:notification.product}};
          this.unreadNotifications.push(newUnreadNotifications);
        });
  }
}
</script>


<style scoped>

</style>