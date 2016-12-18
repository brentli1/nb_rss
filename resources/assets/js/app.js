import $ from 'jquery';
import Vue from 'vue';
import Router from 'vue-router';
import Resource from 'vue-resource';

// Views
// TODO:  Let's figure out a way to put all of these in
// their own single import.
import BaseView from './components/BaseView.vue';
import Categories from './components/Categories.vue';
import CateogoryFeeds from './components/CategoryFeeds.vue';
import FeedList from './components/FeedList.vue';
import FeedItem from './components/FeedItem.vue';
import Modal from './components/Modal/Modal.vue';
import _404 from './base/404';

$(() => {
  Vue.use(Router);
  Vue.use(Resource);
  Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

  // Initialize the router
  let router = new Router({
    routes: [
      { path: '/', component: BaseView },
      { path: '*', component: _404 }
    ],
    mode: 'history'
  });

  // Initialize the global event bus
  window.eventBus = new Vue();

  Vue.component('categories', Categories);
  Vue.component('feed-list', FeedList);
  Vue.component('feed-item', FeedItem);
  Vue.component('category-feeds', CateogoryFeeds);
  Vue.component('modal', Modal);

  // Instantiate the Application
  new Vue({
    el: '#app',
    router: router
  });
});
