<template>
  <div class="home">
    <h1>Landing Page</h1>
    <p>Categories:</p>
    <ul>
      <li v-for="cat in categories">
        {{cat.name}}
      </li>
    </ul>

  </div>
</template>

<script>
  export default {
    data () {
      this.$http.get('/api/category').then((response) => {
        // success callback
        this.categories = response.body;
      }, (response) => {
        // error callback
        return response;
      });

      return {
        categories: []
      }
    }
  }
</script>