<template>
  <ul class="category-feeds">
    <li class="categories-feeds__list-item" v-for="feed in feeds">
      <a href="" class="categories-feeds__list-item-link">{{feed.name}}</a>
    </li>
  </ul>
</template>

<script>
  export default {
    data () {
      this.$http.get('/api/category/'+this.catID).then((response) => {
        // success callback
        this.feeds = response.body;
      }, (response) => {
        // error callback
        return response;
      });

      return {
        feeds: []
      }
    },
    props: [
      'catID'
    ]
  }
</script>