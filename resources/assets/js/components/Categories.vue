<template>
  <section class="categories">
    <h1 class="categories__header">
      Categories
      <a href="" @click.prevent="showCategoryModal('Create')" class="categories__add-cat-link"></a>
    </h1>
    <div class="categories__container">
      <ul class="categories__list">
        <li class="categories__list-item" v-for="cat in categories">
          <a href="" class="categories__list-item-link">{{cat.name}}</a>
          <a href="" @click.prevent="showFeedModal(cat.id, 'Create')" class="categories__add-feed-link">Add Feed</a>
          <category-feeds :catID=cat.id></category-feeds>
        </li>
      </ul>
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        categories: []
      }
    },

    methods: {
      setListeners: function() {
        window.eventBus.$on('push-category', this.pushCategory);
      },

      fetchCategories: function() {
        this.$http.get('/api/category').then((response) => {
          this.categories = response.body;
        });
      },

      pushCategory: function(newCat) {
        this.categories.push(newCat);
      },

      showFeedModal: function(catId, action) {
        window.eventBus.$emit('show-feed-modal', catId, action);
      },

      showCategoryModal: function(action) {
        window.eventBus.$emit('show-cat-modal', action);
      }
    },

    created: function() {
      this.fetchCategories();
      this.setListeners();
    }
  }
</script>