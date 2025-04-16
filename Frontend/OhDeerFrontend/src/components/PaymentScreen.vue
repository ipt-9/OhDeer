<template>
    <div class="page-container">

        <div v-if="loading" class="loading-text">Loading...</div>
        <div v-else-if="error" class="error-text">{{ error }}</div>
        <div v-else class="card">
            <img :src="post.image" alt="Post Image" class="post-image" />
            <h1 class="title">{{ post.title }}</h1>
            <p class="description">{{ post.description }}</p>
            <div class="fee-box">Commission: {{ fee.amount }}%</div>
            <div class="price">CHF {{ post.price.toFixed(2) }}</div>

            <div v-if="post.user" class="user-box">
                <div class="user-label">The user you're getting the item from:</div>
                <div class="username">{{ post.user.username }}</div>
            </div>

            <div class="button-group">
                <button @click="goBack" class="go-back-button">Go Back</button>
                <button @click="pay" class="pay-button">
                    Pay CHF {{ post.price.toFixed(2) }}
                </button>
            </div>
        </div>
    </div>

</template>


<script setup>
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const router = useRouter()
const route = useRoute()
const postId = route.params.id

const post = ref(null)
const fee = ref(null)
const loading = ref(true)
const error = ref(null)

const goBack = () => {
    router.go(-1);
}

const fetchData = async () => {
    /*
        try {
            const response = await fetch(`https://api.ohdeer-bmsd22a.bbzwinf.ch/api/posts/${postId}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                },
            })
    
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`)
            }
    
            const data = await response.json()
            post.value = data
        } catch (err) {
            console.error(err)
            error.value = 'Failed to load post.'
        } finally {
            try {
                const response = await fetch(`https://api.ohdeer-bmsd22a.bbzwinf.ch/api/getFee`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                    },
                })
    
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`)
                }
    
                const data = await response.json()
                fee.value = data
            } catch (err) {
                console.error(err)
                error.value = 'Failed to load post.'
            } finally {
                loading.value = false
            }
        }
    
    */

    post.value = {
        id: 1,
        title: "Broken Motherboard",
        description: "A broken motherboard that doesn't work with my current system anymore.",
        price: 120,
        is_repair: false,
        is_complete: false,
        category_id: 3,
        user_id: 2,
        image: "https://www.budgetpcupgraderepair.com/wp-content/uploads/2020/05/Old-Laptop-computer-motherboard-750x500.png",
        created_at: "2025-04-10T12:00:00Z",
        updated_at: "2025-04-12T15:30:00Z",
        user: {
            id: 2,
            username: "techguru",
            email: "techguru@example.com",
            iban: "CH9300762011623852957"
        }
    }

    fee.value = {
        amount: 12
    }

    loading.value = false
}

const pay = async () => {
    alert(`Processing payment of CHF ${post.value.price.toFixed(2)} for "${post.value.title}"`)

    try {
        const token = localStorage.getItem('token')
        if (token === null) {
            alert('You\'re not logged in. Redirecting to login');
            router.push('/login')
        }

        const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/purchases/saveTransactions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'Authoristion': `Bearer ${token}`
            },
            body: JSON.stringify({
                amount: post.value.amount,
                post_id: post.value.id,
                is_outstanding: true
            })
        });

        const data = await response.json();

        if (!response.ok) {
            this.error = data.message || 'Failed the upload of the transaction.';
            return;
        }

        alert('Uploaded to the server');
        // this.$router.push('/login');
    } catch (err) {
        this.error = 'An error occurred. Please try again.';
        console.error(err);
    }

}

onMounted(fetchData)
</script>

<style scoped>
.page-container {
    min-height: 100vh;
    background-color: #e6e8e6;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
}

.card {
    position: relative;
    width: 100%;
    max-width: 900px;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2.5rem;
    border-radius: 1rem;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25);
}

.loading-text {
    color: white;
    text-align: center;
    font-size: 1.25rem;
}

.error-text {
    color: #ffdddd;
    text-align: center;
    font-size: 1.25rem;
}

.title {
    font-size: 2rem;
    font-weight: 800;
    color: #3b4c14;
    margin-bottom: 1rem;
}

.description {
    color: #333;
    margin-bottom: 1.25rem;
}

.price {
    font-size: 1.25rem;
    font-weight: 600;
    color: #3b4c14;
    margin-bottom: 1rem;
}

.user-box {
    background-color: #4c5c1f;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}

.user-label {
    font-size: 0.85rem;
    color: #f0f0f0;
    margin-bottom: 0.3rem;
}

.username {
    font-family: monospace;
    color: white;
    font-size: 1rem;
}

.button-group {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.go-back-button {
    flex: 1;
    padding: 0.75rem 1.5rem;
    background-color: #d4a017;
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.go-back-button:hover {
    background-color: #b38a10;
}

.pay-button {
    flex: 1;
    padding: 0.75rem 1.5rem;
    background-color: #556b1f;
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.pay-button:hover {
    background-color: #3b4c14;
}

.post-image {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 0.75rem;
    border: 4px solid #3b4c14;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    background-color: white;
}

.card {
    position: relative;
    width: 100%;
    max-width: 720px;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.fee-box {
    font-size: 1rem;
    background-color: #eef3e0;
    color: #3b4c14;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    font-weight: 500;
    border-left: 4px solid #6b8e23;
}
</style>