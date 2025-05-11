<template>
  <div class="search-page">
    <NavBar />
    <div class="content-wrapper">
      <h2 class="page-title">Search Results</h2>
        <div v-if="filteredPosts.length === 0" class="no-results">No results found.</div>
          <div v-else class="posts-grid">
            <router-link 
              v-for="post in filteredPosts" 
              :key="post.id" 
              :to="{ path: `/inspectitem/${post.id}` }"
              class="post-card-link"
            >
            <div class="post-card">
              <h3 class="post-title">{{ post.title }}</h3>
              <img :src="post.image" alt="Post Image" class="post-img" />
              <div class="post-content">
                <p class="post-description">{{ post.description }}</p>
                <p><strong>Category:</strong> {{ post.categoryName }}</p>
                <p class="price"><strong>Price:</strong> CHF {{ post.price }}</p>
                <div class="tags">
                  <span v-if="post.isRepair" class="tag repair">Repair</span>
                  <span v-if="post.isComplete" class="tag complete">Complete</span>
                </div>
              </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>
<script setup>
import { computed, ref, watch, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import NavBar from './nav-bar.vue'

const posts = ref([]);
const route = useRoute();
const searchQuery = ref(route.query.q?.toLowerCase() || '');
const selectedRepairStatus = ref(route.query.repair || '');
const selectedCategory = ref(route.query.category || '');

async function fetchPosts() {
  try {
    const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/posts/all', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error('Failed to fetch posts');
    }

    const data = await response.json();

    posts.value = data
      .filter(post => !post.is_complete)
      .map(post => ({
        id: post.id,
        title: post.title,
        description: post.description,
        price: post.price,
        image: post.image_1,
        isRepair: post.is_repair,
        isComplete: post.is_complete,
        categoryID: post.category_id || null,
        categoryName: categoryMap[post.category_id] || 'Unknown'  
      }));

  } catch (err) {
    console.error('Error fetching posts:', err);
  }
}


function matchesSearch(post, query) {
  if (!query) return true;
  const words = query.trim().toLowerCase().split(/\s+/);
  const haystack = (post.title + ' ' + post.description).toLowerCase();
  return words.every((word) => haystack.includes(word));
}
const categoryMap = {
  1: 'Household Appliances',
  2: 'Electronics',
  3: 'Furniture & Home Items',
  4: 'Clothing & Accessories',
  5: 'Vehicles & Mobility',
  6: 'Luxury & Accessories',
  7: 'Toys & Hobby Items',
  8: 'Services',
  9: 'Automotive',
  10: 'Other'
};


const filteredPosts = computed(() => {
  return posts.value.filter((post) => {
    const matchesQuery = matchesSearch(post, searchQuery.value);
    const matchesRepairStatus = 
      !selectedRepairStatus.value || 
      (selectedRepairStatus.value === 'repair' && post.isRepair) || 
      (selectedRepairStatus.value === 'non-repair' && !post.isRepair);

    const matchesCategory = !selectedCategory.value || post.categoryID === parseInt(selectedCategory.value);

    return matchesQuery && matchesRepairStatus && matchesCategory;
  });
});

watch(
  () => route.query,
  (newQuery) => {
    searchQuery.value = newQuery.q?.toLowerCase() || '';
    selectedRepairStatus.value = newQuery.repair || '';
    selectedCategory.value = newQuery.category || '';
  },
  { immediate: true },
);

onMounted(() => {
  fetchPosts();
});
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
  gap: 1rem; 
  margin-top: 1.5rem;
}

.post-card {
  width: 300px;
  height: 450px; 
  background: white;
  border-radius: 10px;
  padding: 1rem 1.2rem;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  border: 1px solid #ddd;
  transition: transform 0.2s, box-shadow 0.2s;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  cursor: pointer;
  margin: 0.5rem;
}


.post-content {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.post-description {
  font-size: 0.9rem;
  color: #555;
  margin: 0.3rem 0;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2; 
  -webkit-box-orient: vertical;
}

.price {
  font-weight: bold;
  color: #388659;
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

.post-title {
  font-size: 1.2rem;
  font-weight: bold;
  margin: 0.5rem 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  text-align: center; 
}

.post-card-link {
  text-decoration: none;
  color: inherit;
}

.post-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.post-card-link {
  text-decoration: none;
  color: inherit;
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

  .posts-grid {
    gap: 1rem;
  }

  .post-card {
    max-width: 90%;
    height: auto;
  }

  .post-img {
    height: 160px;
  }
}
</style>
