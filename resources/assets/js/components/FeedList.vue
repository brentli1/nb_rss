<template @send-feed-id="setFeedList">
  <section class="feed-list">
    <ul class="">
      <li class="" v-for="item in feedItems">
        <a href="" class="">{{item.name}}</a>
      </li>
    </ul>
  </section>
</template>

<script>
  module.exports = {
    data: function() {
      return {
        // ONLY A TEST
        feedItems: [
          {
            name: 'first-feed-item'
          },
          {
            name: 'second-feed-item'
          }
        ]
      }
    },
    methods: {
      setFeedList: function(id) {
        // ONLY A TEST
        if(id == 1) {
          this.feedItems =
          [
            {
              name: "tate's dream"
            },
            {
              name: "dr. harmon"
            }
          ]
        }
      },
      setListeners: function() {
        window.eventBus.$on('send-feed-id', this.setFeedList);
      }
    },
    created: function() {
      this.setListeners();
    }
  }
</script>