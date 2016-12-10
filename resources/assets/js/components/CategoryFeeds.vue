<template>
  <ul v-if="feeds.length" class="category-feeds">
    <li class="categories-feeds__list-item" v-for="feed in feeds">
      <a href="" @click.prevent="sendFeedId(feed.id)" class="categories-feeds__list-item-link">{{feed.name}}</a>
    </li>
  </ul>
</template>

<script>
  export default {
    data () {
      return {
        feeds: []
      }
    },
    props: [
      'catID'
    ],
    methods: {
      sendFeedId: function(id) {
        window.eventBus.$emit('send-feed-id', id);
      },

      fetchFeeds: function() {
        this.$http.get('/api/category/'+this.catID).then((response) => {
          this.feeds = response.body;
        });
      }
    },
    created: function() {
      this.fetchFeeds();
    }
  }
</script>