<template>
  <section class="categories">
    <h1 class="categories__header">Categories</h1>
    <div class="categories__container">
      <ul class="categories__list">
        <li class="categories__list-item" v-for="cat in categories">
          <a href="" class="categories__list-item-link">{{cat.name}}</a>
          <category-feeds :catID=cat.id></category-feeds>
        </li>
      </ul>
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      this.$http.get('/api/category').then((response) => {
        this.categories = response.body;
      });

      return {
        categories: []
      }
    },
  }
</script>