<template>
    <div class="page-container">

        <div v-if="loading" class="loading-text">Loading...</div>
        <div v-else-if="error" class="error-text">{{ error }}</div>


        <div v-else class="card">
            <div style="display:grid; text-align:left; grid-template-columns: 150px 3fr 1fr;">          
                <div style="grid-column: 1; aspect-ratio: 1 / 1;  margin-right:-20px; border-radius: 2px; border-style:solid; border-color: black; width: 150px; height: 150px; ">
                    <img :src="user.image" alt="Post Image"/>
                </div>

                <div style="margin-left:50px">
                    <h1 style="grid-column: 2;margin-top:0;">{{ user.username }}</h1>
                    <div>{{ user.website }}</div>
                    <div>{{ user.user_type_id }}</div>
                    <div>{{ user.subscription_id }}</div>
                </div>
                
                <div style="grid-column: 3; display:grid">
                    <div style="grid-column: 1;">{{ user.repair_rating }}</div>
                    <div style="grid-column: 2;">{{ user.general_rating }}</div>
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

const loading = ref(true)
const error = ref(null)
const user = ref(null)


const goBack = () => {
    router.go(-1);
}

const fetchData = async () => {
    // user.value = {
    //     username: "exampleuser",
    //     password: "securepassword123",
    //     email: "exampleuser@example.com",
    //     address: "123 Example Street",
    //     postal_code: "1234",
    //     repair_rating: 4.5,
    //     general_rating: 4.7,
    //     phone_number: "+41791234567",
    //     iban: "CH9300762011623852957",
    //     website: "https://exampleuser.com",
    //     language_id: 1,
    //     user_type_id: 2,
    //     subscription_id: 3
    // }

    const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/users/1', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      });

      const data = await response.json();
      user.value = data
        console.log(data.username)
      if (!response.ok) {
        this.error = data.message || 'fetch failed.';
        return;
      }

    loading.value = false
}

onMounted(fetchData)
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

</style>