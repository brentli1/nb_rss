<template>
  <transition name="modal">
    <section v-if="showModal" class="modal">
      <div class="modal__overlay">
        <div class="modal__container">
          <div class="modal__header">
            <span class="modal__title">{{this.action}} {{this.type}}</span>
            <button @click="showModal = false" class="modal__close">Close</button>
          </div>
          <div class="modal__form-container">
            <form v-if="type == 'Feed'" @submit.prevent="action == 'Edit' ? editFeed() : createFeed()">
              <label class="modal__label" for="feed-name">Feed Name</label>
              <input class="modal__input" type="text" v-model="feed.name" name="feed-name">
              <label class="modal__label" for="feed-url">Feed RSS URL</label>
              <input class="modal__input" v-model="feed.url_path" type="text" name="feed-url">
              <input class="modal__submit" type="submit" value="Submit">
            </form>
            <form v-if="type == 'Category'" @submit.prevent="action == 'Edit' ? editCat(cat.id) : createCat()">
              <label class="modal__label" for="cat-name">Category Name</label>
              <input class="modal__input" type="text" v-model="cat.name" name="cat-name">
              <input class="modal__submit" type="submit" value="Submit">
            </form>
            <div class="modal__alert">{{this.message}}</div>
          </div>
        </div>
      </div>
    </section>
  </transition>
</template>

<script>
  module.exports = {
    data: function() {
      return {
        showModal: false,
        action: '',
        type: '',
        message: '',
        feed: {
          id: '',
          name: '',
          url_path: '',
          category_id: ''
        },
        cat: {
          id: '',
          name: ''
        }
      }
    },

    methods: {
      setListeners: function() {
        window.eventBus.$on('show-feed-modal', this.showFeedModal);
        window.eventBus.$on('show-cat-modal', this.showCatModal);
      },

      showFeedModal: function(catId, action, feed = {}) {
        this.showModal = true;
        this.addFeed = true;
        this.action = action;
        this.feed.category_id = catId;
        this.type = 'Feed';

        if(feed !== null) {
          this.feed.id = feed.id;
          this.feed.name = feed.name;
          this.feed.url_path = feed.url_path;
        }
      },

      showCatModal: function(action) {
        this.showModal = true;
        this.addCat = true;
        this.action = action;
        this.type = 'Category';
      },

      createCat: function() {
        this.$http.post('/api/category/create', this.cat).then((res) => {
          this.cat.id = res.body;
          this.message = 'Category Created Successfully';
          window.eventBus.$emit('push-category', this.cat);
        });
      },

      createFeed: function() {
        this.$http.post('/api/category/feed/create/' + this.cat.id, this.feed).then((res) => {
          this.feed.id = res.body;
          this.message = 'Feed Created Successfully';
          window.eventBus.$emit('push-feed', this.feed);
        });
      },

      editFeed: function() {
        this.$http.put('/api/category/feed/edit/' + this.feed.id, this.feed).then((res) => {
          window.eventBus.$emit('update-feed', this.feed);
        });
      },

      closeModal: () => {
        this.showModal = false;
        this.action = '';
        this.type = '';
        this.message = '';
      }
    },

    created: function() {
      this.setListeners();
    }
  }
</script>