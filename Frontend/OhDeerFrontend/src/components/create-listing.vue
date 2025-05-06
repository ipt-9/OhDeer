<template>
  <div class="create-listing">
    <h2>Create New Listing</h2>

    <div v-if="false" class="warning">You must be logged in to create a listing.</div>

    <div v-else>
      <label>
        Listing Type:
        <select v-model="listingType">
          <option value="product">Product</option>
          <option value="repair" :disabled="!canCreateRepairShop">Repair Shop</option>
        </select>
      </label>

      <div class="form-section">
        <label>Title: <input v-model="title" type="text" /></label>
        <label>Description: <textarea v-model="description"></textarea></label>
        <label>Price: <input v-model.number="price" type="number" /></label>
        <label>Category:
          <select v-model="categoryId">
            <option value="1">Household Appliances</option>
            <option value="2">Electronics</option>
            <!-- Add more categories here -->
          </select>
        </label>
      </div>

      <button @click="submitListing">Submit Listing</button>

      <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
      <div v-if="successMessage" class="success">{{ successMessage }}</div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'


const token = ref('')
const isLoggedIn = ref(false)
const canCreateRepairShop = ref(false)

const listingType = ref('product')
const title = ref('')
const description = ref('')
const price = ref(0)
const categoryId = ref(1)

const errorMessage = ref('')
const successMessage = ref('')

onMounted(() => {
  token.value = localStorage.getItem('token')
  console.log('Stored token: ', token.value)
  if (!token.value) {
    isLoggedIn.value = false
    return
  }

  isLoggedIn.value = true
})



async function submitListing() {
  errorMessage.value = ''
  successMessage.value = ''

  if (!isLoggedIn.value) {
    errorMessage.value = 'You must be logged in to create a listing.'
    return
  }

  const payload = {
    category_id: categoryId.value,
    title: title.value,
    description: description.value,
    price: price.value,
    is_repair: listingType.value === 'repair',
    image_1: 'https://en.m.wikipedia.org/wiki/File:Example_image.svg'
  }

  try {
    const res = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/posts/create', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token.value}`,
        Accept: 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(payload)
    })

    if (!res.ok) {
      const errData = await res.json()
      throw new Error(errData.message || 'Failed to create listing')
    }

    successMessage.value = 'Listing created successfully!'
  } catch (err) {
    errorMessage.value = err.message
  }
}
</script>


<style scoped>
.create-listing {
  max-width: 500px;
  margin: 2rem auto;
  padding: 1.5rem;
  border: 1px solid #ccc;
  border-radius: 8px;
}
.form-section {
  display: flex;
  flex-direction: column;
  gap: 0.8rem;
  margin-top: 1rem;
}
.warning {
  color: darkred;
  font-weight: bold;
}
.error {
  color: red;
  margin-top: 1rem;
}
.success {
  color: green;
  margin-top: 1rem;
}
</style>
