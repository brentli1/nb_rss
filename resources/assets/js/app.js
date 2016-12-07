import $ from 'jquery';
import Vue from 'vue';
import Router from 'vue-router';
import Resource from 'vue-resource';

// Views
// TODO:  Let's figure out a way to put all of these in
// their own single import.
import App from './components/App.vue';
import HomeView from './components/HomeView.vue';
import _404 from './base/404';

$(() => {
  Vue.use(Router);
  Vue.use(Resource);

  // Initialize the router
  let router = new Router({
    routes: [
      { path: '/', component: HomeView },
      { path: '*', component: _404 }
    ],
    mode: 'history'
  });

  // Instantiate the Application
  new Vue({
    el: '#app',
    router: router,
    template: '<router-view class="main-body" keep-alive transition transition-mode="out-in"></router-view>'
  });

});
