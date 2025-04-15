<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
const { title, id } = route.params
</script>
<template>
<h1>{{ id }}</h1>
<h1>{{ title }}</h1>
</template>
<style scoped>

</style>