import Vue from "vue";
import VueRouter from "vue-router";
import Homepage from "../components/HomePage/HomePage";
import Login from "../components/Auth/Login";
import SignUp from "../components/Auth/SignUp";
import Movies from "../components/MoviesPage/Movies";

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
