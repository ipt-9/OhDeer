<template>
  <div class="search-page">
    <NavBar />

    <div class="content-wrapper">
      <h2 class="page-title">Search Results</h2>

      <div v-if="filteredPosts.length === 0" class="no-results">No results found.</div>

      <div v-else class="posts-grid">
        <div v-for="post in filteredPosts" :key="post.PostId" class="post-card">
          <h3>{{ post.Title }}</h3>
          <p>{{ post.Description }}</p>
          <img :src="post.Image" alt="Post Image" class="post-img" />
          <p><strong>Category:</strong> {{ getCategoryName(post.fk_CategoryId) }}</p>
          <p><strong>Price:</strong> CHF {{ post.Price }}</p>
          <div class="tags">
            <span v-if="post.IsRepair" class="tag repair">Repair</span>
            <span v-if="post.IsComplete" class="tag complete">Complete</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import NavBar from './nav-bar.vue'

const posts = ref([
  {
    PostId: 1,
    fk_CategoryId: 1,
    fk_CustomerId: 101,
    Title: 'Washing Machine',
    Description: 'Need someone to fix a broken washer.',
    Price: 80,
    IsRepair: true,
    IsComplete: false,
    Image: 'https://thumbs.dreamstime.com/b/broken-washing-machine-dump-246342207.jpg',
  },
  {
    PostId: 2,
    fk_CategoryId: 2,
    fk_CustomerId: 102,
    Title: 'Sell Old Laptop',
    Description: 'Used laptop in good condition for sale.',
    Price: 300,
    IsRepair: false,
    IsComplete: true,
    Image: 'https://source.unsplash.com/400x300/?laptop',
  },
])

const categories = [
  { id: 1, slug: 'household-appliances', name: 'Household Appliances' },
  { id: 2, slug: 'electronics', name: 'Electronics' },
]

const route = useRoute()
const searchQuery = ref(route.query.q?.toLowerCase() || '')

const selectedCategories = ref(
  (route.query.categories || '').split(',').filter((c) => c.trim() !== ''),
)
function getCategoryName(catId) {
  return categories.find((c) => c.id === catId)?.name || 'Unknown'
}

function matchesSearch(post, query) {
  if (!query) return true

  const words = query.trim().toLowerCase().split(/\s+/)
  const haystack = (post.Title + ' ' + post.Description).toLowerCase()
  return words.every((word) => haystack.includes(word))
}

const filteredPosts = computed(() => {
  return posts.value.filter((post) => {
    const matches = matchesSearch(post, searchQuery.value)

    const catSlug = categories.find((c) => c.id === post.fk_CategoryId)?.slug?.toLowerCase()
    const matchesCategory =
      selectedCategories.value.length === 0 || selectedCategories.value.includes(catSlug)

    return matches && matchesCategory
  })
})

watch(
  () => route.query,
  (newQuery) => {
    searchQuery.value = newQuery.q?.toLowerCase() || ''
    selectedCategories.value = (newQuery.categories || '').split(',').filter((c) => c.trim() !== '')
  },
  { immediate: true },
)
</script>

<style scoped>
.search-page {
  background-color: #f8f8f8;
  min-height: 100vh;
}

.content-wrapper {
  padding: 2rem 3rem;
}

.page-title {
  font-size: 1.8rem;
  font-weight: bold;
  margin: 1rem 0;
  text-align: center;
}

.no-results {
  font-size: 1.1rem;
  font-style: italic;
  color: #555;
  margin-top: 1rem;
  text-align: center;
}

.posts-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 1.5rem;
  margin-top: 1.5rem;
}

.post-card {
  flex: 1 1 300px;
  max-width: 360px;
  background: white;
  border-radius: 10px;
  padding: 1rem 1.2rem;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  border: 1px solid #ddd;
  transition: transform 0.2s;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.post-card:hover {
  transform: translateY(-3px);
}

.post-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 0.8rem;
}

.tags {
  margin-top: 0.6rem;
}

.tag {
  display: inline-block;
  padding: 0.2rem 0.6rem;
  font-size: 0.85rem;
  border-radius: 6px;
  margin-right: 0.5rem;
  background-color: #eee;
  font-weight: 500;
}
.tag.repair {
  background-color: #f0c14b;
}
.tag.complete {
  background-color: #c8e6c9;
}

@media (max-width: 768px) {
  .content-wrapper {
    padding: 1rem;
  }

  .page-title {
    font-size: 1.5rem;
  }

  .post-img {
    height: 160px;
  }

  .post-card {
    padding: 1rem;
  }
}
</style>
