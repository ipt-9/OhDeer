<template>
  <div class="container">
    <h1>Backend Connection Showcase</h1>
    <button @click="fetchPosts">Fetch All Posts</button>

    <input v-model="post_id" placeholder="Input post ID">
    <button @click="fetchPost(post_id)">Fetch Specified Post</button>

    <pre v-if="data" style="background-color: #141414; color: white;">{{ data }}</pre>
    <p v-if="error" class="error">Error: {{ error }}</p>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  setup() {
    const data = ref(null);
    const error = ref(null);
    const post_id = ref(''); // Reactive variable for post ID input

    const fetchPosts = async () => {
      try {
        error.value = null;
        const response = await fetch('http://127.0.0.1:8000/api/posts/all');
        if (!response.ok) {
          throw new Error('Failed to fetch data');
        }
        data.value = await response.json();
      } catch (err) {
        error.value = err.message;
      }
    };

    const fetchPost = async (id) => {
      if (!id) {
        error.value = "Please enter a valid post ID.";
        return;
      }
      try {
        error.value = null;
        const response = await fetch(`http://127.0.0.1:8000/api/posts/${id}`); //When backend address is implemented, swap for the correct address
        if (!response.ok) {
          throw new Error('Failed to fetch data');
        }
        data.value = await response.json();
      } catch (err) {
        error.value = err.message;
      }
    };

    return { data, error, post_id, fetchPosts, fetchPost };
  }
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: auto;
  text-align: center;
}

input {
  margin: 10px;
  padding: 5px;
}

pre {
  background-color: #ffffff;
  padding: 10px;
  border-radius: 5px;
  text-align: left;
  white-space: pre-wrap;
}

.error {
  color: red;
}
</style>
