import Vue from "vue";
import VueRouter from "vue-router";
import Homepage from "../components/HomePage/HomePage";
import Login from "../components/Auth/Login";
import SignUp from "../components/Auth/SignUp";
import Movies from "../components/MoviesPage/MoviesMain";
import Profile from "../components/ProfilePage/ProfileMain";
import ProfileMainWall from "../components/ProfilePage/MoviesWall/MainWall";
import ProfileMoviesList from "../components/ProfilePage/MoviesList/MoviesList";
import ProfileEdit from "../components/UserSettings/ProfileEdit";
import ProfileEditProfile from "../components/UserSettings/ProfileEditProfile";
import AdminMenu from "../components/AdminSettings/AdminMenu";
import AdminUsers from "../components/AdminSettings/AdminUsers/AdminUsers";
import MoviePage from "../components/MoviesPage/MoviePage/MoviePage";
import AboutPage from "../components/AboutPage";

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
    path: "/profile/:id/edit",
    name: "ProfileEdit",
    component: ProfileEdit,
    children: [
      {
        path: "profile",
        name: "ProfileEditProfile",
        component: ProfileEditProfile
      },
    ]
  },
  {
    path: "/adminMenu",
    name: "AdminMenu",
    component: AdminMenu,
    children: [
      {
        path: "users",
        name: "AdminUsers",
        component: AdminUsers
      },
    ]
  },
  {
    path: "/movie/:id",
    name: "MoviePage",
    component: MoviePage,
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
  },
  {
    path: "/about",
    name: "AboutPage",
    component: AboutPage,
  },
];

const router = new VueRouter({
  mode: "history",
  routes,
  base: "/"
});

export default router;
