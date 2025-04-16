<template>
  <div class="search-bar-wrapper">
    <div class="search-input">
      <input
        type="text"
        v-model="searchQuery"
        placeholder="Search by name..."
        @keyup.enter="submitSearch"
      />
    </div>
    <div class="filter-dropdown">
      <div @click="toggleDropdown" class="dropdown-toggle">
        Filter by Category ▾
      </div>
      <div class="dropdown-menu" v-show="dropdownOpen" @click.stop>
        <div v-for="option in categoryOptions" :key="option.slug">
          <label class="checkbox-label">
            <input
              type="checkbox"
              :value="option.slug"
              v-model="selectedCategories"
            />
            {{ option.label }}
          </label>
        </div>
      </div>
    </div>
/posts/create


    <div class="search-button" @click="submitSearch">
      Search
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const searchQuery = ref('')
const selectedCategories = ref([])
const dropdownOpen = ref(false)

const categoryOptions = [
  { slug: "furniture-home", label: "Furniture & Home Items" },
  { slug: "electronics", label: "Electronics" },
  { slug: "household-appliances", label: "Household Appliances" }
]

function toggleDropdown() {
  dropdownOpen.value = !dropdownOpen.value
}

function submitSearch() {
  router.push({
  path: '/search-results',
  query: {
    q: searchQuery.value.trim(),
    categories: selectedCategories.value.join(',')
  }
})

}

function categoryLabel(slug) {
  const found = categoryOptions.find(cat => cat.slug === slug)
  return found ? found.label : slug
}
</script>

<style>
.search-bar-wrapper {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 1rem;
  background-color: transparent;
  padding: 0;
  max-width: 100%;
}

.search-input input {
  padding: 0.4rem 0.8rem;
  font-size: 0.95rem;
  border: 1px solid #ccc;
  border-radius: 6px;
  width: 200px;
}

.dropdown-toggle {
  padding: 0.4rem 0.8rem;
  border: 1px solid #ccc;
  border-radius: 6px;
  background-color: #f5f5f5;
  cursor: pointer;
  font-size: 0.95rem;
  transition: background-color 0.2s;
}
.dropdown-toggle:hover {
  background-color: #e6e6e6;
}

.filter-dropdown {
  position: relative;
  user-select: none;
}

.dropdown-menu {
  position: absolute;
  top: calc(100% + 4px);
  left: 0;
  min-width: 250px;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 1rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 10;
}

.checkbox-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.95rem;
  margin-bottom: 0.4rem;
  cursor: pointer;
  transition: background-color 0.2s;
  padding: 0.25rem;
  border-radius: 4px;
}

.checkbox-label:hover {
  background-color: #f0f0f0;
}

input[type="checkbox"] {
  cursor: pointer;
}

.search-button {
  background-color: #6b8e23;
  color: white;
  padding: 0.5rem 1rem;
  font-size: 0.95rem;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.2s, box-shadow 0.2s;
}

.search-button:hover {
  background-color: #5a7f1a;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}
</style>
