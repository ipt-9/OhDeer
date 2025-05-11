<template>
  <div class="search-bar">
    <input
      v-model="searchQuery"
      type="text"
      placeholder="Search items..."
    />

    <select v-model="selectedRepairStatus">
      <option value="">All Items</option>
      <option value="repair">Repair Items</option>
      <option value="non-repair">Non-Repair Items</option>
    </select>

    <select v-model="selectedCategory">
      <option value="">All Categories</option>
      <option value="furniture-home-items">Furniture & Home Items</option>
      <option value="electronics">Electronics</option>
      <option value="household-appliances">Household Appliances</option>
      <option value="clothing-accessories">Clothing & Accessories</option>
      <option value="vehicles-mobility">Vehicles & Mobility</option>
      <option value="luxury-accessories">Luxury & Accessories</option>
      <option value="toys-hobby-items">Toys & Hobby Items</option>
      <option value="other">Other</option>
      <option value="services">Services</option>
      <option value="automotive">Automotive</option>
    </select>

    <button @click="onSearch">Search</button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const searchQuery = ref('');
const selectedRepairStatus = ref('');
const selectedCategory = ref('');

function onSearch() {
  const queryParams = new URLSearchParams();

  if (searchQuery.value) {
    queryParams.append('q', searchQuery.value);
  }

  if (selectedRepairStatus.value) {
    queryParams.append('repair', selectedRepairStatus.value);
  }

  if (selectedCategory.value) {
    queryParams.append('categories', selectedCategory.value); 
  }

  window.location.href = `/search-results?${queryParams.toString()}`;
}
</script>


<style scoped>
.search-bar {
  display: flex;
  gap: 0.5rem;
  align-items: center;
}

input[type="text"] {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 200px;
}

select {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  padding: 0.6rem 1.2rem;
  background-color: #388659;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #2c6a4e;
}
</style>
