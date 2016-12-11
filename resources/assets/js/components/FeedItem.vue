<template>
  <section class="feed-item">
    <div class="feed-item__menu-bar">
      
    </div>
    <div class="feed-item__content-wrapper">
      <base target="_blank">
      <h1 class="feed-item__title">{{item.title}}</h1>
      <div class="feed-item__date">{{item.pubDate}}</div>
      <div class="feed-item__description" v-html="item.content">
        {{item.content}}
      </div>
      <a :href="item.link" class="feed-item__link-to">Link to this.</a>
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
      }
    },
    created: function() {
      this.setListeners();
    }
  }
</script>