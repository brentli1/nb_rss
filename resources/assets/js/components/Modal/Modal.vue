<template>
  <transition name="modal">
    <section v-if="showModal" class="modal">
      <div class="modal__overlay">
        <div class="modal__container">
          <div class="modal__header">
            <span class="modal__title">Add Feed</span>
            <button @click="showModal = false" class="modal__close">Close</button>
          </div>
          <div class="modal__form-container">
            <form action="">
              <label class="modal__label" for="feed-name">Feed Name</label>
              <input class="modal__input" type="text" name="feed-name">
              <label class="modal__label" for="feed-url">Feed RSS URL</label>
              <input class="modal__input" type="text" name="feed-url">
              <input class="modal__submit" type="submit" value="Submit">
            </form>
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
        addFeed: false,
        id: ''
      }
    },

    methods: {
      setListeners: function() {
        window.eventBus.$on('show-add-feed-modal', this.showAddFeedModal);
      },

      showAddFeedModal: function(catId) {
        this.showModal = true;
        this.addFeed = true;
        this.id = catId;
      },

      closeModal: function() {
        this.addFeed = false;
        this.showModal = false;
        this.id = '';
      }
    },

    created: function() {
      this.setListeners();
    }
  }
</script>