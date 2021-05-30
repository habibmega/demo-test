<template>
  <div class="container">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/signin" class="nav-link">Sign in</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/signup" class="nav-link">Sign up</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/list" class="nav-link">List</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/listview" class="nav-link">User</router-link>
        </li>
      </ul>
    </nav><br />
    <transition>
      <router-view></router-view>
    </transition>
  </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
</style>

<script>
export default{
	data() {
		return {
			falg: false,

		}
	}
}
</script>
