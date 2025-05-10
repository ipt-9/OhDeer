<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import navBar from './nav-bar.vue'

const route = useRoute()
const item = ref(null)
const errorMessage = ref('')
const { id } = route.params

async function fetchItem() {
  try {
    const response = await fetch(`https://api.ohdeer-bmsd22a.bbzwinf.ch/api/posts/${id}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })

    if (!response.ok) {
      throw new Error('Failed to fetch item')
    }

    const data = await response.json()
    item.value = {
      title: data.title,
      description: data.description,
      phone: data.phone_number || 'No phone info',
      email: data.email || 'No email info',
      price: data.price,
      image: data.image_1 || 'https://api.ohdeer-bmsd22a.bbzwinf.ch/OhDeerPlaceholder.png',
    }
  } catch (err) {
    errorMessage.value = err.message
    console.error('Error fetching item:', err)
  }
}

onMounted(() => {
  fetchItem()
})
</script>

<template>
  <main>
    <navBar />
    <div class="container">
      <div class="item">
        <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
        <div v-else-if="item" class="grid">
          <div class="card">
            <img :src="item.image" alt="Item Image" class="image" />
          </div>
          <div class="card">
            <div class="infoGrid">
              <div class="title">
                <h1>{{ item.title }}</h1>
              </div>
              <div class="info">
                <h4 class="lab1">Description:</h4>
                <p class="desc">{{ item.description }}</p>
                
                <h4 class="lab2">Delivery:</h4>
                <p class="deliv">{{ item.delivery }}</p>
                
                <h4 class="lab3">Phone:</h4> 
                <p class="inf1">{{ item.phone }}</p>    
                
                <h4 class="lab4">Email:</h4>
                <p class="inf2">{{ item.email }}</p>
              </div>
              <div class="space"></div>
              <div class="footer">
                <h4 class="price">{{ item.price }} CHF</h4>
                <router-link to="/marketplace">
                  <button class="but">Back to Marketplace</button>
                </router-link>
              </div>
            </div>
          </div>                
        </div>                                    
      </div>
    </div>
  </main>
</template>

<style scoped>
.container {
  max-width: 1400px;
  margin: auto;
  padding: 20px;
  font-family: 'Poppins', sans-serif;
}

.item {
  display: flex;
  flex-direction: column;
  gap: 30px;
  padding: 20px;
}

.grid {
  display: grid;
  grid-template-columns: 1.5fr 1fr;
  gap: 20px;
  padding: 10px;
}

.image {
  grid-area: a;
  width: 100%;
  height: 600px;
  object-fit: contain;
  border-radius: 12px;
}

@media (max-width: 768px) {
  .Grid {
    grid-template-columns: 1fr;
  }

  .slideshow {
    height: 300px;
  }
}

h3 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 15px;
  color: black;
}

h4 {
  margin: 5px 0;
  font-size: 15px;
  font-weight: bold;
  color: black;
}

p {
  font-size: 14px;
  color: black;
  margin: 5px 0;
}

.card {
  background: white;
  border-radius: 12px;
  padding: 15px;
  text-align: center;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
  transition:
    transform 0.3s,
    box-shadow 0.3s;
}

.infoGrid {
  display: flex;
  flex-direction: column;
  height: 100%;
  margin-left: 10%;
  margin-right: 10%;
  color: black;
}

.title {
  text-align: center;
  margin-bottom: 16px;
}

.info {
  display: grid;
  grid-template-columns: 1fr 4fr;
  gap: 6px 12px;
}

.spacer {
  flex-grow: 1;
}

.footer {
  margin-top: auto;
  text-align: center;
}

.lab1 {
  font-weight: bold;
  text-align: left;
}

.lab2 {
  font-weight: bold;
  text-align: left;
}

.lab3 {
  font-weight: bold;
  text-align: left;
}

.lab4 {
  font-weight: bold;
  text-align: left;
}

.inf1 {
  overflow-wrap: break-word;
  word-break: break-all;
  white-space: normal;
  text-align: left;
}

.inf2 {
  overflow-wrap: break-word;
  word-break: break-all;
  white-space: normal;
  text-align: left;
}

.deliv {
  overflow-wrap: break-word;
  word-break: break-all;
  white-space: normal;
  text-align: left;
}

.desc {
  overflow-wrap: break-word;
  word-break: break-all;
  white-space: normal;
  text-align: left;
}

.price {
  font-weight: bold;
  font-size: 16px;
  color: #388659;
  text-align: center;
}

.but {
  background: #388659;
  color: white;
  border: none;
  padding: 10px 16px;
  margin-top: 10px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  transition: 0.3s ease;
  align-items: center;
}

button:hover {
  opacity: 0.9;
  transform: scale(1.05);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}
</style>
