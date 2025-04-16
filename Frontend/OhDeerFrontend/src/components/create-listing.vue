<template>
  <div class="create-listing">
    <h2>Create a New Listing</h2>
    <form @submit.prevent="submitForm">
      <label>Title:</label>
      <input v-model="title" required />

      <label>Description:</label>
      <textarea v-model="description" required></textarea>

      <label>Price (CHF):</label>
      <input type="number" v-model.number="price" required />

      <label>Category:</label>
      <select v-model="categoryId" required>
        <option value="1">Household Appliances</option>
        <option value="2">Electronics</option>
      </select>

      <label>
        <input type="checkbox" v-model="isRepair" />
        Is Repair
      </label>

      <button type="submit">Submit</button>
      <p v-if="successMessage" class="success">{{ successMessage }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const title = ref('')
const description = ref('')
const price = ref(0)
const categoryId = ref(1)
const isRepair = ref(false)
const successMessage = ref('')

const token = '1|WDTkFFTB1DveHSG8CPwu2k6ZnR1luNN5qFgOBYw52fc1f132'

const submitForm = async () => {
  try {
    const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/posts/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        category_id: categoryId.value,
        title: title.value,
        description: description.value,
        price: price.value,
        is_repair: isRepair.value
      })
    })

    const data = await response.json()

    if (response.ok) {
      successMessage.value = 'Listing successfully created!'
      title.value = ''
      description.value = ''
      price.value = 0
      categoryId.value = 1
      isRepair.value = false
    } else {
      alert('Error: ' + data.message || 'Something went wrong')
    }
  } catch (err) {
    console.error('Error submitting form:', err)
    alert('Failed to submit form')
  }
}
</script>

<style scoped>
.create-listing {
  max-width: 500px;
  margin: 2rem auto;
  padding: 1.5rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #fff;
}
label {
  display: block;
  margin: 1rem 0 0.3rem;
  font-weight: 500;
}
input, textarea, select {
  width: 100%;
  padding: 0.5rem;
  border-radius: 4px;
  border: 1px solid #ccc;
}
button {
  margin-top: 1rem;
  padding: 0.6rem 1.2rem;
  background-color: #6b8e23;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
button:hover {
  background-color: #556b2f;
}
.success {
  margin-top: 1rem;
  color: green;
}
</style>
