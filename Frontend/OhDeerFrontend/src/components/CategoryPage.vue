<template>
  <div class="categoryPage">
    <h2>Category: {{ formattedCategory }}</h2>
    <p>Showing products for this category...</p>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
const formattedCategory = route.params.slug.replace("-", " ");
</script>

<style>
.categoryPage {
  padding: 20px;
  text-align: center;
}
</style>
