import Vue from "vue";
import VueRouter from "vue-router";
import Homepage from "../components/HomePage/HomePage";
import Login from "../components/Auth/Login";
import SignUp from "../components/Auth/SignUp";
import Movies from "../components/MoviesPage/MoviesMain";
import Profile from "../components/ProfilePage/ProfileMain";
import ProfileMainWall from "../components/ProfilePage/MainWall";
import ProfileMoviesList from "../components/ProfilePage/MoviesList";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "HomePage",
    component: Homepage
  },
  {
    path: "/movies",
    name: "Movies",
    component: Movies
  },
  {
    path: "/profile/:id",
    name: "Profile",
    component: Profile,
    children: [
      {
        path: "main",
        name: "ProfileMainWall",
        component: ProfileMainWall
      },
      {
        path: "movies",
        name: "ProfileMoviesList",
        component: ProfileMoviesList
      }
    ]
  },
  {
    path: "/login",
    name: "Login",
    component: Login
  },
  {
    path: "/signUp",
    name: "SignUp",
    component: SignUp
  }
];

const router = new VueRouter({
  mode: "history",
  routes,
  base: "/"
});

export default router;
