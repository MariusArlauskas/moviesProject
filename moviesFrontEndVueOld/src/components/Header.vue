<template>
    <header>
      <ul>
        <li>
          <a class="active" href="/"><v-img contain max-height="25px" max-width="25px" src="../assets/logo.png" ></v-img> </a>
        </li>
        <li>
          <a style="color: white" href="/login">Login</a>
        </li>
        <li>
          <a style="color: white" href="/signup">Register</a>
        </li>
        <li v-if="ROLE === 'ROLE_USER' || ROLE === 'ROLE_ADMIN'" style="float: right">
          <a style="color: white">Logout</a>
        </li>
      </ul>
    </header>
</template>

<script>
export default {
  name: "headerCustom",
  components: {  },
};
</script>

<style>
header {
    height: 5%;
    background-color: var(--v-primary-base);
}

ul {
  display: flex;
  align-items: center;
  list-style-type: none;
}

li {
  font-family: 'Courier New', Courier, monospace;
}

li a {
  display: block;
  text-align: center;
  padding: 10px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: rgb(65, 60, 136);
}

.active {
  background-color: var(--v-secondary-base);
}
</style>