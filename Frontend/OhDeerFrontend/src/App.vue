<script setup>
import { useRoute } from 'vue-router'

const route = useRoute()
</script>

<template>
  <div class="app-wrapper" :class="{ 'auth-layout': route.meta.layout === 'auth' }">
    <header v-if="route.meta.layout !== 'auth'">

    </header>

    <router-view />
  </div>
</template>

<style scoped>
.app-wrapper.auth-layout {
  background: url('/assets/forest-bg.jpg') no-repeat center center;
  background-size: cover;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.app-wrapper:not(.auth-layout) {
  min-height: 100vh;
  background: #fff;
}
</style>
