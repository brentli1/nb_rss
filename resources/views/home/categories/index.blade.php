<section class="home-categories">
  <h1 class="home-categories__title">Categories</h1>
  @each('home.categories.category', Auth::user()->categories, 'category')
</section>