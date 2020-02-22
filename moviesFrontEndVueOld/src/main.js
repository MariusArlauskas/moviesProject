import Vue from 'vue';
import vuetify from './plugins/vuetify';
import VueRouter from 'vue-router';
import axios from 'axios'
import store from './stores/store'
import App from './App.vue';

import Login from './components/Auth/Login'
import Signup from './components/Auth/Signup'
import ToDo from './components/Todo'
// import Tasks from './components/GenresFolder/Tasks'
// import GenresModal from './components/GenresFolder/GenresModal'
// import GenreMovieInfoModal from './components/GenresFolder/GenreMovieInfoModal'
// // import NotesModal from './components/NotesModal'
// import MovieGenres from './components/MoviesFolder/MovieGenres'
// import MoviesModal from './components/MoviesFolder/MoviesModal'
// import MovieGenreInfoModal from './components/MoviesFolder/MovieGenreInfoModal'
// import UserMovies from './components/UsersFolder/UserMovies'

Vue.config.productionTip = false;

Vue.use(VueRouter);

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
axios.defaults.withCredentials = true;

const routes = [
  {
    path: '/',
    component: ToDo,
    name: "todo",
  //   children: [
  //     {
  //       path: 'genres/:id',
  //       components: { genres: Tasks },
  //       name: "genres",
  //       children: [
  //         {
  //           path: 'movie/:movieId',
  //           components: { genreMovieInfoModal: GenreMovieInfoModal },
  //           name: "genreMovieInfoModal"
  //         },
  //         {
  //           path: '',
  //           components: { genresEdit: GenresModal },
  //           name: "genresEdit"
  //         }
  //       ]
  //     },
  //     {
  //       path: 'movie/:id',
  //       components: { movieGenres: MovieGenres },
  //       name: "movieGenres",
  //       children: [
  //         {
  //           path: 'genre/:genreId',
  //           components: { movieGenreInfoModal: MovieGenreInfoModal },
  //           name: "movieGenreInfoModal"
  //         },
  //         {
  //           path: '',
  //           components: { moviesEdit: MoviesModal },
  //           name: "moviesEdit"
  //         }
  //       ]
  //     },
  //     {
  //       path: 'user/:id',
  //       components: { userMovies: UserMovies },
  //       name: "userMovies",
  //       children: [
  //         {
  //           path: 'movie/:movieId',
  //           components: { userMovieInfo: GenreMovieInfoModal },
  //           name: "userMovieInfo"
  //         }
  //       ]
  //     },
  //     // {
  //     //   path: 'myMovie/:id',
  //     //   components: { myMovieGenres: MovieGenres },
  //     //   name: "myMovieGenres",
  //     //   children: [
  //     //     {
  //     //       path: 'genre/:genreId',
  //     //       components: { movieGenreInfoModal: MovieGenreInfoModal },
  //     //       name: "movieGenreInfoModal"
  //     //     }
  //     //   ]
  //     // },
  //   ]
  },
  {
    path: '/login',
    component: Login,
    name: "login"
  },
  {
    path: '/signup',
    component: Signup,
    name: "signup"
  }
];

const router = new VueRouter({
  mode: 'history',
  routes,
  base: '/'
})

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')