<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import navBar from './nav-bar.vue'

const route = useRoute()
const repair = ref(null)
const errorMessage = ref('')
const { id } = route.params

async function fetchRepair() {
  try {
    const response = await fetch(`https://api.ohdeer-bmsd22a.bbzwinf.ch/api/posts/${id}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })

    if (!response.ok) {
      throw new Error('Failed to fetch repair details')
    }

    const data = await response.json()
    repair.value = {
      title: data.title,
      description: data.description,
      link: data.website || 'No website info', 
      address: data.address || 'No address info',
      postalCode: data.postal_code || 'No postal code',
      email: data.email || 'No email info',
      phone: data.phone_number || 'No phone info',
      image: data.image_1 || 'https://api.ohdeer-bmsd22a.bbzwinf.ch/OhDeerPlaceholder.png',
    }
  } catch (err) {
    errorMessage.value = err.message
    console.error('Error fetching repair:', err)
  }
}

onMounted(() => {
  fetchRepair()
})
</script>
<template>
  <main>
    <navBar />
    <div class="container">
      <div class="item">
        <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
        <div v-else-if="repair" class="grid">
          <div class="card">
            <img :src="repair.image" alt="Repair Image" class="image" />
          </div>
          <div class="card">
            <div class="infoGrid">
              <div class="title">
                <h1>{{ repair.title }}</h1>
              </div>
              <div class="info">
                <h4 class="lab1">Description:</h4>
                <p class="desc">{{ repair.description }}</p>
                
                <h4 class="lab2">Link:</h4>
                <p class="inf1"><a :href="repair.link" target="_blank">{{ repair.link }}</a></p>
                
                <h4 class="lab3">Address:</h4>
                <p class="inf2">{{ repair.address }}</p>
                
                <h4 class="lab4">Postal Code:</h4> 
                <p class="inf3">{{ repair.postalCode }}</p>    
                
                <h4 class="lab5">Email:</h4>
                <p class="inf4">{{ repair.email }}</p>
                
                <h4 class="lab6">Phone:</h4>
                <p class="inf5">{{ repair.phone }}</p>
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

.lab5 {
  font-weight: bold;
  text-align: left;
}

.lab6 {
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

.inf3 {
  overflow-wrap: break-word;
  word-break: break-all;
  white-space: normal;
  text-align: left;
}

.inf4 {
  overflow-wrap: break-word;
  word-break: break-all;
  white-space: normal;
  text-align: left;
}

.inf5 {
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
</style>
