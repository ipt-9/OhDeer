<template>
    <div class="max-w-xl mx-auto p-6">
      <div v-if="loading" class="text-center">Loading...</div>
      <div v-else-if="error" class="text-red-500 text-center">{{ error }}</div>
      <div v-else>
        <h1 class="text-2xl font-bold mb-2">{{ post.title }}</h1>
        <p class="mb-4 text-gray-700">{{ post.description }}</p>
        <div class="mb-4 text-lg font-semibold">CHF {{ post.price.toFixed(2) }}</div>
        <div class="mb-2">
          <span class="text-sm text-gray-600">Repair: </span>
          <span :class="post.is_repair ? 'text-green-600' : 'text-red-600'">
            {{ post.is_repair ? 'Yes' : 'No' }}
          </span>
        </div>
        <
  
        <button
          @click="pay"
          class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"
        >
          Pay CHF {{ post.price.toFixed(2) }}
        </button>
      </div>
    </div>
  </template>
  
  <script setup>
  

  import { onMounted, ref } from 'vue'
  import { useRoute } from 'vue-router'

  const route = useRoute()
  const postId = route.params.id
  
  const post = ref(null)
  const loading = ref(true)
  const error = ref(null)
  
  const fetchPost = async () => {
  try {
    const response = await fetch(`https://api.placeholder.ch/posts/${postId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
      },
    })

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`)
    }

    const data = await response.json()
    post.value = data
  } catch (err) {
    console.error(err)
    error.value = 'Failed to load post.'
  } finally {
    loading.value = false
  }
}
  
  const pay = () => {
    alert(`Processing payment of CHF ${post.value.price.toFixed(2)} for "${post.value.title}"`)
  }
  
  onMounted(fetchPost)
  </script>
  
  <style scoped>
  body {
    font-family: 'Segoe UI', sans-serif;
  }
  </style>
  