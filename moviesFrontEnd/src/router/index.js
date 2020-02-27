import Vue from "vue";
import VueRouter from "vue-router";
import Homepage from "../components/HomePage";
import Login from "../components/Auth/Login";
import SignUp from "../components/Auth/SignUp";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "HomePage",
    component: Homepage
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
