<template>
  <navBar></navBar>
  <div class="create-listing">
    <h2>Create New Listing</h2>

    <div v-if="!isLoggedIn" class="warning">You must be logged in to create a listing.</div>

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
        <label>Image Link: <input v-model="imageLink" type="text" placeholder="https://example.com/image.jpg" /></label>
        <label>Category:
          <select v-model="categoryId">
            <option value="1">Furniture & Home Items</option>
            <option value="2">Electronics</option>
            <option value="3">Household Appliances</option>
            <option value="4">Clothing & Accessories</option>
            <option value="5">Vehicles & Mobility</option>
            <option value="6">Luxury & Accessories</option>
            <option value="7">Toys & Hobby Items</option>
            <option value="8">Services</option>
            <option value="9">Automotive</option>
            <option value="10">Other</option>
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
import navBar from "./nav-bar.vue";
import { ref, onMounted } from 'vue';

const token = ref('');
const isLoggedIn = ref(false);
const canCreateRepairShop = ref(true); // Setting as true because we cant change the subscriptions in the backend

const listingType = ref('product');
const title = ref('');
const description = ref('');
const price = ref(0);
const categoryId = ref(1);
const imageLink = ref('');

const errorMessage = ref('');
const successMessage = ref('');

onMounted(() => {
  token.value = localStorage.getItem('token');
  if (!token.value) {
    isLoggedIn.value = false;
    return;
  }
  isLoggedIn.value = true;
});

async function submitListing() {
  errorMessage.value = '';
  successMessage.value = '';

  if (!isLoggedIn.value) {
    errorMessage.value = 'You must be logged in to create a listing.';
    return;
  }

  if (!title.value || !description.value || !price.value || !imageLink.value) {
    errorMessage.value = 'Please fill out all fields.';
    return;
  }

  const payload = {
    category_id: parseInt(categoryId.value),
    title: title.value,
    description: description.value,
    price: parseFloat(price.value),
    is_repair: listingType.value === 'repair',
    image_1: imageLink.value,
  };

  try {
    const res = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/posts/create', {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${token.value}`,
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(payload),
    });

    if (!res.ok) {
      const errData = await res.json();
      throw new Error(errData.message || 'Failed to create listing');
    }

    successMessage.value = 'Listing created successfully!';
    title.value = '';
    description.value = '';
    price.value = 0;
    imageLink.value = '';
  } catch (err) {
    errorMessage.value = `Error: ${err.message}`;
  }
}
</script>


<style scoped>
.create-listing {
  max-width: 600px;
  margin: 2rem auto;
  padding: 2rem;
  border: 1px solid #e0e0e0;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  background-color: #ffffff;
  transition: all 0.3s ease;
}

.create-listing:hover {
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

h2 {
  text-align: center;
  margin-bottom: 1.5rem;
  color: #333;
  font-size: 1.8rem;
}

.form-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-top: 1rem;
}

label {
  font-weight: bold;
  color: #555;
}

input,
textarea,
select {
  width: 100%;
  padding: 0.8rem;
  margin-top: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: #f9f9f9;
  transition: border-color 0.3s ease;
}

input:focus,
textarea:focus,
select:focus {
  outline: none;
  border-color: #6b8e23;
  background-color: #fff;
}

textarea {
  resize: vertical;
  min-height: 100px;
}

button {
  width: 100%;
  padding: 0.8rem;
  background-color: #6b8e23;
  color: #fff;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #556b2f;
}

button:active {
  background-color: #4a5e21;
}

.warning,
.error,
.success {
  text-align: center;
  padding: 0.8rem;
  margin-top: 1rem;
  border-radius: 6px;
}

.warning {
  background-color: #ffe5e5;
  color: #b22222;
}

.error {
  background-color: #ffe5e5;
  color: #b22222;
}

.success {
  background-color: #e5ffe5;
  color: #228b22;
}

@media (max-width: 768px) {
  .create-listing {
    padding: 1.5rem;
  }

  h2 {
    font-size: 1.6rem;
  }

  button {
    font-size: 0.9rem;
  }

  input,
  textarea,
  select {
    padding: 0.6rem;
  }
}
</style>
