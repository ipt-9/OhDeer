<template>
  <div class="page-container">
    <div v-if="loading" class="loading-text">Loading...</div>
    <div v-else-if="error" class="error-text">{{ error }}</div>
    <div v-else-if="user && user.length"> No User found!</div>
    <div v-else>
      <div class="card">
        <div class="profile-grid">
          <div class="avatar-container">
            <div class="avatar">
              <img
                :src="user.profile_image"
                alt="Post Image"
                style="height: 100%; width: 100%; object-fit: cover"
              />
            </div>
            <div class="subscription-label">
              <div>{{ 'Deer ' + user.subscription.subscription_name }}</div>
            </div>
          </div>

          <div class="profile-info">
            <h1 style="margin-top: 0">{{ user.username }}</h1>
            <a :href="user.website" target="_blank" class="button">Go to Website</a>
          </div>

          <div class="ratings">
            <div class="rating-column">
              <div>General</div>
              <div v-for="i in 5" :key="i">
                <span v-if="i <= user.general_rating">★</span>
                <span v-else>☆</span>
              </div>
            </div>
            <div class="rating-column">
              <div>Repair</div>
              <div v-for="i in 5" :key="i">
                <span v-if="i <= user.repair_rating">★</span>
                <span v-else>☆</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="isOwnProfile" class="card-inset">
        <h2 style="margin-bottom: 1rem; font-size: 1.5rem; color: #333">
          Further Account Information
        </h2>
        <ul class="account-info">
          <li><strong>E-Mail:</strong> {{ user.email }}</li>
          <li><strong>Phone Number:</strong> {{ user.phone_number }}</li>
          <li><strong>Address:</strong> {{ user.address }}</li>
          <li><strong>Account Type:</strong> {{ user.user_type.user_type_name }}</li>
          <li><strong>Language:</strong> {{ user.language.language_name }}</li>
        </ul>
        <div style="display: flex; justify-content: flex-end">
          <button class="button">Settings</button>
        </div>
      </div>

      <div class="card card-description">
        <div style="display: grid; grid-template-rows: auto 1fr auto">
          <div>Placeholder Text</div>
          <div style="display: flex; justify-content: flex-end">
            <button v-if="!isOwnProfile" class="button">Request Repair</button>
            <button v-else class="button">Edit Description</button>
          </div>
        </div>
      </div>

      <div class="grid-posts">
        <div>
          <div>Posts</div>
          <hr />

          <div v-if="posts">
            <div style="display: flex; justify-content: center">
              <div class="carousel-container">
                <div style="justify-content: center; display: flex">
                  <div class="carousel-track" ref="carouselTrack">
                    <div class="carousel-spacer"></div>

                    <div class="carousel-slide" v-for="post in posts" :key="post.id">
                      <div class="carousel-image-wrapper">
                        <img :src="post.image_1" alt="Post Image" class="carousel-image" />
                      </div>
                      <div>
                        <h3>{{ truncateTitle(post.title) }}</h3>
                        <p><b>Price:</b> ${{ post.price.toFixed(2) }}</p>
                        <p><b>Needs repair:</b> {{ post.is_repair ? 'Yes' : 'No' }}</p>
                      </div>
                    </div>
                    <div class="carousel-spacer"></div>
                  </div>
                </div>

                <div class="carousel-controls">
                  <button @click="scrollCarousel(-1)" class="button">Prev</button>
                  <button @click="scrollCarousel(1)" class="button">Next</button>
                </div>
              </div>
            </div>
            <div>
              <button class="button" style="width: 100%; margin-top: 20px">All Posts</button>
            </div>
          </div>
          <div v-else class="card">No Posts</div>
        </div>
      </div>

      <div class="grid-reviews">
        <div>
          <div>Reviews</div>
          <hr />

          <div v-if="ratings && ratings.length">
            <div>
              <div
                v-for="rating in ratings"
                :key="rating.id"
                class="card"
                style="margin-top: 20px; padding: 10px; width: 100%; text-align: start"
              >
                <span style="font-size: 18px; font-weight: bold">
                  <span v-for="i in 5" :key="i" style="font-size: 24px">
                    <span v-if="i <= rating.repair_rating">★</span>
                    <span v-else>☆</span>
                  </span>
                </span>
                <span style="font-size: 20px; color: #555; margin-left: 1rem">
                  <strong>Comment:</strong> {{ shortenComment(rating.rating_comment) }}
                </span>
              </div>
            </div>
            <div>
              <button class="button" style="width: 100%; margin-top: 20px">All Ratings</button>
            </div>
          </div>
          <div v-else class="card">No ratings</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const router = useRouter()
const route = useRoute()
const userId = route.params.id
const isOwnProfile = ref(false)

const loading = ref(true)
const error = ref(null)
const user = ref(null)
const ratings = ref(null)
const posts = ref(null)
const fetchUrl = 'http://127.0.0.1:8000'

function shortenComment(comment) {
  return comment.length > 100 ? comment.substring(0, 100) + '...' : comment
}

const goBack = () => {
  router.go(-1)
}

async function fetchFromApi(path = '') {
  try {
    const response = await fetch(`${fetchUrl}/api/users/${userId}${path}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
      },
    })

    const data = await response.json()

    if (!response.ok) {
      throw new Error(data.message || 'Fetch failed.')
    }

    return data
  } catch (err) {
    error.value = err.message
    return null
  }
}

const fetchAllData = async () => {
  user.value = await fetchFromApi()
  posts.value = await fetchFromApi('/posts')
  ratings.value = await fetchFromApi('/ratings')

  loading.value = false
}

onMounted(async () => {
  fetchAllData()

  const token = localStorage.getItem('token')
  if (!token) return

  const res = await fetch(`${fetchUrl}/api/users/user`, {
    headers: {
      Authorization: `Bearer ${token}`,
      Accept: 'application/json',
    },
  })

  const data = await res.json()

  if (data.id == userId) {
    isOwnProfile.value = true
  }
})

const carouselTrack = ref(null)

const scrollCarousel = (direction) => {
  const container = carouselTrack.value
  if (!container) return

  const slide = container.querySelector('.carousel-slide')
  if (!slide) return

  const gap = 16
  const scrollAmount = slide.offsetWidth + gap

  container.scrollBy({
    left: direction * scrollAmount,
    behavior: 'smooth',
  })
}

function truncateTitle(title) {
  const words = title.split(' ')
  return words.length > 4 ? words.slice(0, 4).join(' ') + '...' : title
}
</script>

<style scoped>
.card {
  background: #ffffff;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 700px;
  text-align: center;
}

.card-inset {
  background: #ffffff;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: inset 0 8px 24px rgba(0, 0, 0, 0.1);
  margin-top: 2rem;
}

.page-container {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 2rem;
  background-color: #f6f9fc;
  min-height: 100vh;
  gap: 2rem;
  flex-wrap: wrap;
}

.button {
  padding: 0.75rem 1.25rem;
  background-color: #3b6f63;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
}

.avatar {
  aspect-ratio: 1 / 1;
  border-radius: 90px;
  border: solid 1px black;
  overflow: hidden;
  margin-right: -20px;
  max-width: 100%;
}

.avatar-container {
  max-width: 150px;
  width: 100%;
}

.subscription-label {
  margin-top: 1rem;
  padding: 0.5rem;
  border-radius: 10px;
  border: solid 1px black;
  text-align: center;
}

.profile-info {
  margin-left: 2rem;
  text-align: left;
  flex: 1;
}

.profile-grid {
  display: grid;
  grid-template-columns: 150px 1fr 1fr;
  text-align: left;
  gap: 1rem;
}

.ratings {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.rating-column {
  display: flex;
  flex-direction: column;
  align-items: center;
  font-size: 1.25rem;
}

.account-info {
  list-style: none;
  padding: 0;
  margin: 0;
  font-size: 0.95rem;
  line-height: 1.6;
}

.card-description {
  margin-top: 3rem;
  text-align: start;
  width: 100%;
}

.grid-posts,
.grid-reviews {
  display: grid;
  gap: 1rem;
  margin-top: 3rem;
}

.carousel-container {
  width: 100%;
  overflow: hidden;
  margin-top: 1rem;
  max-width: 700px;
}

.carousel-track {
  display: flex;
  overflow-x: auto;
  overflow: hidden;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
  gap: 1rem;
  padding: 0 2rem 1rem;
}

.carousel-slide {
  flex: 0 0 auto;
  scroll-snap-align: center;
  background: white;
  padding: 1rem;
  border-radius: 1rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: auto;
}

.carousel-image-wrapper {
  width: 100%;
  aspect-ratio: 4 / 3;
  overflow: hidden;
  border-radius: 12px;
  margin-bottom: 1rem;

  max-width: 400px;
}

.carousel-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.carousel-controls {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-top: 0.5rem;
}

.carousel-spacer {
  flex: 0 0 15%;
  pointer-events: none;
}

@media (max-width: 830px) {
  .profile-grid {
    grid-template-columns: 1fr;
    text-align: center;
    display: flex;
    align-items: center;
    flex-direction: column;
  }

  .profile-info {
    margin-left: 0;
    margin-top: 1rem;
    text-align: center;
  }

  .page-container {
    flex-direction: column;
    align-items: center;
    padding: 2rem;
    width: 100%;
    box-sizing: border-box;
  }

  .card {
    box-sizing: border-box;
  }

  .carousel-container {
    width: 100%;
    max-width: 500px;
    margin-top: 1rem;
  }

  .carousel-track {
    gap: 0.5rem;
    padding: 0 1rem 1rem;
  }

  .carousel-slide {
    flex: 0 0 80%;
    max-width: 100%;
  }

  .carousel-slide h3,
  .carousel-slide p {
    text-align: center;
    word-break: break-word;
    overflow-wrap: break-word;
    margin: 0.25rem 0;
    font-size: 0.95rem;
  }

  .carousel-image-wrapper {
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    border-radius: 12px;
    margin-bottom: 1rem;
  }

  .carousel-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .carousel-controls {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 0.5rem;
  }

  .carousel-spacer {
    flex: 0 0 15%;
    pointer-events: none;
  }
}
</style>
