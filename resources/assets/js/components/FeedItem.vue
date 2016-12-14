<template>
  <section class="feed-item">
    <div class="feed-item__menu-bar">
      <a href="#" class="feed-item__read" @click.prevent="markRead" v-if="item.is_read == 0">Mark Read</a>
      <span class="feed-item__read" v-else>Read</span>
      <a href="#" class="feed-item__starred" @click.prevent="markStarred" v-if="item.starred == 0">Mark Starred</a>
      <a href="#" class="feed-item__starred" @click.prevent="unStar" v-else-if="item.starred == 1">Unstar</a>
    </div>
    <div class="feed-item__content-wrapper">
      <base target="_blank">
      <h1 class="feed-item__title">{{item.title}}</h1>
      <div class="feed-item__date">{{item.pubDate}}</div>
      <div class="feed-item__description" v-html="item.content">
        {{item.content}}
      </div>
      <a :href="item.feed_link" class="feed-item__link-to">Link to this.</a>
    </div>
  </section>
</template>

<script>
  module.exports = {
    data: function() {
      return {
        item: []
      }
    },

    methods: {
      setListeners: function() {
        window.eventBus.$on('show-feed-item', this.showFeedContent);
      },

      showFeedContent: function(item) {
        this.item = item;
      },

      markRead: function() {
        this.$http.get('/api/feed_items/' + this.item.id + '/mark_read').then((res) => {
          this.item.is_read = res.body;
        }, (error) => {
          console.log(error)
        });
      },

      markStarred: function() {
        this.$http.get('/api/feed_items/' + this.item.id + '/star').then((res) => {
          this.item.starred = res.body;
        }, (error) => {
          console.log(error)
        });
      },

      unStar: function() {
        this.$http.get('/api/feed_items/' + this.item.id + '/unstar').then((res) => {
          this.item.starred = res.body;
        }, (error) => {
          console.log(error)
        });
      }
    },

    created: function() {
      this.setListeners();
    }
  }
</script>
