<template>
  <ul v-if="feeds.length" class="category-feeds">
    <li class="category-feeds__list-item" v-for="feed in feeds">
      <a href="" @click.prevent="sendFeedUrl(feed.url_path, feed.id)" class="category-feeds__list-item-link">{{feed.name}}</a>
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
      sendFeedUrl: function(url, feed_id) {
        window.eventBus.$emit('send-feed-url', url, feed_id);
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
