<template>
  <div class="search-bar-wrapper">
    <div class="search-input">
      <input
        type="text"
        v-model="searchQuery"
        placeholder="Search by name..."
        @input="$emit('update:searchQuery', searchQuery)"
      />
    </div>

    <div class="filter-dropdown" @click="toggleDropdown">
      <span>Filter by Category ▾</span>
      <div class="dropdown-menu" v-show="dropdownOpen">
        <div v-for="category in categories" :key="category.id">
          <label>
            <input
              type="checkbox"
              :value="category.slug"
              v-model="selectedCategories"
              @change="$emit('update:selectedCategories', selectedCategories)"
            />
            {{ category.name }}
          </label>
        </div>
      </div>
    </div>

    <div v-if="noResults" class="no-results">
      No items found.
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
const emit = defineEmits(['update:searchQuery', 'update:selectedCategories']);

const searchQuery = ref('');
const selectedCategories = ref([]);
const dropdownOpen = ref(false);


const categories = [
  { id: 1, name: "Furniture & Home Items", slug: "furniture-home" },
  { id: 2, name: "Electronics", slug: "electronics" },
  { id: 3, name: "Household Appliances", slug: "household-appliances" },
  { id: 4, name: "Clothing & Accessories", slug: "clothing-accessories" },
  { id: 5, name: "Vehicles & Mobility", slug: "vehicles-mobility" },
  { id: 6, name: "Luxury & Accessories", slug: "luxury-accessories" },
  { id: 7, name: "Toys & Hobby Items", slug: "toys-hobby" },
  { id: 8, name: "More Categories", slug: "more-categories" }
];

watch(searchQuery, (val) => emit('update:searchQuery', val));
watch(selectedCategories, (val) => emit('update:selectedCategories', val));

function toggleDropdown() {
  dropdownOpen.value = !dropdownOpen.value;
}
</script>


<style scoped>
.search-bar-wrapper {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 1rem;
  padding: 1rem;
  background-color: #f9f9f9;
  border-radius: 8px;
  width: 100%;
  max-width: 500px;
}

.search-input input {
  width: 100%;
  padding: 0.6rem;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.filter-dropdown {
  position: relative;
  cursor: pointer;
  user-select: none;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin-top: 0.3rem;
  z-index: 10;
}

.dropdown-menu label {
  display: block;
  margin-bottom: 0.4rem;
  font-size: 0.95rem;
}

.no-results {
  color: #a94442;
  font-style: italic;
  font-size: 0.9rem;
  margin-top: 0.5rem;
}
</style>
