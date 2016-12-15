<template @send-feed-id="setFeedList">
  <section class="feed-list">
    <ul class="feed-list__items">
      <li class="feed-list__item" v-for="item in feedItems">
        <a href="" @click.prevent="showFeedItem(item)" class="feed-list__link">
          <h1 class="feed-list__headline">{{item.title}}</h1>
          <div class="feed-list__author">{{item.author}}</div>
          <div class="feed-list__pub-date">{{item.pubDate}}</div>
        </a>
        <span v-if="item.starred == 1" class="feed-list__star"></span>
      </li>
    </ul>
  </section>
</template>

<script>
  module.exports = {
    data: function() {
      return {
        feedItems: []
      }
    },

    methods: {
      setFeedList: function(url, feed_id) {
        this.$http.get('http://api.rss2json.com/v1/api.json?rss_url=' + url).then((res) => {
          this.$http.post('/api/feed_items/' + feed_id, res.body.items).then((data) => {
            this.feedItems = data.body;
          }, (err) => { console.log('error', err); });
        });
      },

      setListeners: function() {
        window.eventBus.$on('send-feed-url', this.setFeedList);
      },

      showFeedItem: function(item) {
        window.eventBus.$emit('show-feed-item', item);
      }
    },

    created: function() {
      this.setListeners();
    },

    updated: function() {
      $('.feed-list__link').on('click', function() {
        $('.feed-list__link').parent().removeClass('feed-list__item--selected');
        $(this).parent().addClass('feed-list__item--selected');
      });
    }
  }
</script>
