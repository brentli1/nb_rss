<template>
  <ul v-if="feeds.length" class="category-feeds">
    <li class="category-feeds__list-item" v-for="feed in feeds">
      <a href="" @click.prevent="sendFeedUrl(feed.url_path, feed.id)" class="category-feeds__list-item-link">{{feed.name}}</a>
      <a href="" @click.prevent="openEditFeed('Edit', feed)" class="category-feeds__list-item-edit"></a>
    </li>
  </ul>
</template>

<script>
  export default {
    data () {
      return {
        feeds: [],
        feedIndex: ''
      }
    },

    props: [
      'catID'
    ],

    methods: {
      setListeners: function() {
        window.eventBus.$on('push-feed', this.pushFeed);
        window.eventBus.$on('update-feed', this.updateFeed);
      },
      
      sendFeedUrl: function(url, feed_id) {
        window.eventBus.$emit('send-feed-url', url, feed_id);
      },

      fetchFeeds: function() {
        this.$http.get('/api/category/'+this.catID).then((response) => {
          this.feeds = response.body;
        });
      },

      pushFeed: function(newFeed) {
        if(this.catID == newFeed.category_id) {
          this.feeds.push(newFeed);
        }
      },

      updateFeed: function(feed) {
        if(this.catID == feed.category_id) {
          this.$set(this.feeds, this.feedIndex, {'name': feed.name, 'url_path': feed.url_path});
        }
      },

      openEditFeed: function(action, feed) {
        this.feedIndex = this.feeds.indexOf(feed);
        window.eventBus.$emit('show-feed-modal', feed.category_id, action, feed);
      }
    },

    created: function() {
      this.fetchFeeds();
      this.setListeners();
    }
  }
</script>
