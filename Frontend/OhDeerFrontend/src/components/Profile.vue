<template>
    <div class="page-container">

        <div v-if="loading" class="loading-text">Loading...</div>
        <div v-else-if="error" class="error-text">{{ error }}</div>

        <div v-else>
            <div class="card">
                    <div style="display:grid; text-align:left; grid-template-columns: 150px 3fr 1fr;">       
                        <div style="grid-column: 1; width: 150px; height: 220px; ">
                            <div style="aspect-ratio: 1 / 1;  margin-right:-20px; border-radius: 90px; border-style:solid; border-color: black; overflow: hidden;">
                                <img :src="user.profile_image" alt="Post Image" style="height:100%; width:100%; object-fit: cover;"/>
                            </div>

                            <div style="margin-right:-20px; margin-top: 20px; padding: 0.5rem; border-radius: 10px; border-style:solid; border-color: black; text-align: center;">
                                <div>{{ "Deer " + user.subscription.subscription_name }}</div>
                            </div>
                        </div>   


                        <div style="margin-left:50px">
                            <h1 style="grid-column: 2;margin-top:0;">{{ user.username }}</h1>

                            <a :href="user.website" target="_blank" class="button">Go to Website</a>
                        </div>
                        
                        <div style="grid-column: 3; display:grid; text-align: center;">

                            <div style="grid-column: 1; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                                <div>General</div>
                                <div v-for="i in 5" :key="i" style="font-size: 24px;">
                                    <span v-if="i <= user.repair_rating">★</span>
                                    <span v-else>☆</span>
                                </div>
                            </div>
                            <div style="grid-column: 2; ">
                                <div style="grid-column: 1; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                                    <div>Repair</div>
                                    <div v-for="i in 5" :key="i" style="font-size: 24px;">
                                        <span v-if="i <= user.general_rating">★</span>
                                        <span v-else>☆</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div v-if="isOwnProfile" style="background: #ffffff;padding: 2rem;border-radius: 1rem;box-shadow: inset 0 8px 24px rgba(0, 0, 0, 0.1); margin-top: 30px;">
                    <h2 style="margin-bottom: 1rem; font-size: 1.5rem; color: #333;">Further Account Information</h2>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 0.5rem;">
                        <strong>E-Mail:</strong> {{ user.email }}
                        </li>
                        <li style="margin-bottom: 0.5rem;">
                        <strong>Phone Number:</strong> {{ user.phone_number }}
                        </li>
                        <li style="margin-bottom: 0.5rem;">
                        <strong>Address:</strong> {{ user.address }}
                        </li>
                        <li style="margin-bottom: 0.5rem;">
                        <strong>Account Type:</strong> {{ user.user_type.user_type_name }}
                        </li>
                        <li>
                        <strong>Language:</strong> {{ user.language.language_name }}
                        </li>
                    </ul>

                    <div style="display: flex; justify-content: flex-end;">
                        <button class="button" >Settings</button>

                    </div>
                </div>

                <div class="card" style="margin-top: 50px; text-align: start;">
                    <div style="display: grid; grid-template-rows: auto 1fr auto; ">    
                        <div >Placeholder Text</div>      
                        <div style="display: flex; justify-content: flex-end;">
                            <button v-if="!isOwnProfile" class="button">Request Repair</button>
                            <button v-else class="button">Edit Description</button>
                        </div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns: 1; grid-template-rows: 2;  margin-top: 50px;">
                    <div style="grid-row: 1;">
                        <div>Posts</div>
                        <hr>
                        <div class="carousel">
                            <div class="track" :style="trackStyle">
                            <div class="slide" v-for="post in posts" :key="post.id">
                                <h3>{{ post.title }}</h3>
                                <p>Price: ${{ post.price.toFixed(2) }}</p>
                                <p>Needs repair: {{ post.is_repair ? 'Yes' : 'No' }}</p>
                            </div>
                            </div>
                            <button @click="prev">Prev</button>
                            <button @click="next">Next</button>
                        </div>
                    </div>

                    <div style="grid-row: 2;">
                        <button style=" width: 100%; margin-top: 20px;" class="button">All Posts</button>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns: 1; grid-template-rows: 2; margin-top: 50px;">
                    <div style="grid-row: 1;">

                        <div>Reviews</div>
                        <hr>

                        <div>
                            <!-- Loop through the ratings array to display rating cards -->
                            <div v-for="(rating) in ratings" :key="rating.id" class="card" style="margin-top: 20px; padding: 10px; width:100%; text-align: start;">
                                    <span style="font-size: 18px; font-weight: bold;"> 
                                        <span v-for="i in 5" :key="i" style="font-size: 24px;">
                                            <span v-if="i <= rating.repair_rating">★</span>
                                            <span v-else>☆</span>
                                        </span>
                                    </span>

                                    <span style=" font-size: 20px; color: #555; margin-left: 1rem;">
                                        <strong>Comment:</strong> {{ shortenComment(rating.rating_comment) }}
                                    </span>
                            </div>
                        </div>

                        </div>

                    <div style="grid-row: 2;">
                        <button style=" width: 100%; margin-top: 20px;" class="button">All Ratings</button>
                    </div>
                </div>

        </div>
        
    </div>
</template>


<script setup>

import { onMounted, ref, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const router = useRouter()
const route = useRoute()
const userId = route.params.id
const isOwnProfile = ref(false);

const loading = ref(true)
const error = ref(null)
const user = ref(null)
const ratings = ref(null)
const posts = ref(null)
const fetchUrl = "http://127.0.0.1:8000"//"https://api.ohdeer-bmsd22a.bbzwinf.ch"

function shortenComment(comment) {
    return comment.length > 100 ? comment.substring(0, 100) + '...' : comment;
}   

const goBack = () => {
    router.go(-1);
}

async function fetchFromApi(path = '') {
  try {
    const response = await fetch(`${fetchUrl}/api/users/${userId}${path}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
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

    const token = localStorage.getItem('token');
    if (!token) return;

    const res = await fetch(`${fetchUrl}/api/users/user`, {
        headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
        }
    });

    const data = await res.json()

    if (data.id == userId){isOwnProfile.value = true}
});



const currentIndex = ref(0)

const trackStyle = computed(() => ({
  transform: `translateX(-${currentIndex.value * 50}%)`,
}))

const prev = () => {
  currentIndex.value = (currentIndex.value - 1 + posts.value.length) % posts.value.length
}

const next = () => {
  currentIndex.value = (currentIndex.value + 1) % posts.value.length
}


</script>

<style scoped>
.card{
    background: #ffffff;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    width: 700px;
    text-align: center;
}
.page-container{
    display:flex;
    justify-content: center;
    align-items: flex-start;
    padding: 2rem;
    background-color: #f6f9fc;
    min-height: 100vh;
    gap: 3rem;
    flex-wrap: wrap;
}

.button{
    padding: 12px 20px; 
    background-color: #3b6f63; 
    color: white; 
    border: none; 
    border-radius: 8px; 
    font-size: 1rem; 
    cursor: pointer;
}



.carousel {
  width: 300px;
  overflow: hidden;
  position: relative;
}

.track {
  display: flex;
  transition: transform 0.3s ease;
}

.slide {
  width: 100%;
  flex-shrink: 0;
  padding: 10px;
  box-sizing: border-box;
  border: 1px solid #ccc;
}
</style>