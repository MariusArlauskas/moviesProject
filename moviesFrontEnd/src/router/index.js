import Vue from "vue";
import VueRouter from "vue-router";
import Homepage from "../components/HomePage/HomePage";
import Login from "../components/Auth/Login";
import SignUp from "../components/Auth/SignUp";
import MoviesPage from "../components/MoviesPage/MoviesPage";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "HomePage",
    component: Homepage
  },
  {
    path: "/movies",
    name: "MoviesPage",
    component: MoviesPage
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
