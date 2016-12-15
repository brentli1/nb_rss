<template>
  <section class="categories">
    <h1 class="categories__header">Categories</h1>
    <div class="categories__container">
      <ul class="categories__list">
        <li class="categories__list-item" v-for="cat in categories">
          <a href="" class="categories__list-item-link">{{cat.name}}</a>
          <a href="" @click.prevent="showAddFeedModal(cat.id)" class="categories__add-feed-link">Add Feed</a>
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
      fetchCategories: function() {
        this.$http.get('/api/category').then((response) => {
          this.categories = response.body;
        });
      },

      showAddFeedModal: function(catId) {
        window.eventBus.$emit('show-add-feed-modal', catId);
      }
    },

    created: function() {
      this.fetchCategories();
    }
  }
</script>