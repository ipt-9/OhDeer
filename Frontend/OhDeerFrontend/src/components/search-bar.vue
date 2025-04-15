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
      <button type="button" @click="toggleDropdown" class="dropdown-toggle">
        Filter by Category ▾
      </button>
      <div class="dropdown-menu" v-show="dropdownOpen" @click.stop>
        <div v-for="option in categoryOptions" :key="option.slug">
          <label>
            <input
              type="checkbox"
              :value="option.slug"
              v-model="selectedCategories"
              @change="submitSearch"
            />
            {{ option.label }}
          </label>
        </div>
      </div>
    </div>



    <button @click="submitSearch">Search</button>

    <div v-if="noResults" class="no-results">
      No items found.
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
    name: 'SearchResults',
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


<style scoped>
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

.filter-dropdown {
  position: relative;
  cursor: pointer;
  user-select: none;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  min-width: 250px;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 1rem;
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
