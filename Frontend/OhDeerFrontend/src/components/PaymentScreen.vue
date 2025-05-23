<template>
  <div v-if="post && fee">
    <div class="checkout-container">
      <div class="product-summary">
        <h3 class="product-title">{{ post.title }}</h3>
        <p class="product-description">{{ post.description }}</p>
        <img :src="post.image_1" alt="Post Image" class="product-image" />
        <div class="seller-info">
          <span>Sold by:</span> <br />
          <strong>{{ post.user.username }}</strong>
        </div>
      </div>

      <div class="payment-form">
        <h2>Complete Your Payment</h2>
        <div class="price-label">Price of Item: CHF {{ post.price.toFixed(2) }}</div>
        <div class="fee-box">
          <span>Commission: {{ Math.round(fee.amount) }}%</span>
          <div class="info-container">
            <span v-if="!showInfo" class="info-icon" @click="showInfo = !showInfo">ℹ️</span>
            <span v-else class="info-icon" @click="showInfo = !showInfo">✖</span>
            <div v-if="showInfo" class="info-popup">
              <p>
                If you're interested in where this commission goes and who it helps, we invite you
                to read our GTC.
              </p>
              <router-link to="/comingsoon" exact-active-class="active"
                >Read our general terms and conditions here</router-link
              >
            </div>
          </div>
        </div>
        <div class="price-label">Commision: CHF {{ commission.toFixed(2) }}</div>
        <div class="price-label">Total: CHF {{ totalprice.toFixed(2) }}</div>
        <div class="button-group">
          <button @click="goBack" class="go-back-button">Go Back</button>
          <button @click="pay" class="pay-button">Pay CHF {{ totalprice.toFixed(2) }}</button>
        </div>
      </div>
    </div>
  </div>
  <div v-else-if="error" class="error-text">{{ error }}</div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const router = useRouter()
const route = useRoute()
const postId = route.params.id

const error = ref(null)
const post = ref(null)
const fee = ref(null)
const showInfo = ref(false)
const totalprice = ref(null)
const commission = ref(null)

const goBack = () => {
  router.go(-1)
}

const fetchData = async () => {
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
    return null
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
        throw new Error(data.message || `Fetch failed.`)
      }

      const data = await response.json()
      fee.value = data
    } catch (err) {
      console.error(err)
      error.value = 'Failed to load post.'
    }
  }

  commission.value = post.value.price * (fee.value.amount / 100.0)
  totalprice.value = post.value.price * (fee.value.amount / 100.0) + post.value.price
}

const pay = async () => {
  alert(`Processing payment of CHF ${post.value.price.toFixed(2)} for "${post.value.title}"`)

  try {
    const token = localStorage.getItem('token')
    if (token === null) {
      alert("You're not logged in. Redirecting to login")
      router.push('/login')
    }

    const response = await fetch(
      'https://api.ohdeer-bmsd22a.bbzwinf.ch/api/purchases/saveTransactions',
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({
          amount: post.value.price,
          post_id: post.value.id,
          is_outstanding: true,
        }),
      },
    )

    if (!response.ok) {
      if (response.status === 401) {
        alert("You're not logged in. Redirecting to login")
        router.push('/login')
      }
      this.error = data.message || 'Failed the upload of the transaction.'
      return
    }

    const data = await response.json()

    alert('Uploaded to the server')
    router.push('/comingsoon')
  } catch (err) {
    this.error = 'An error occurred. Please try again.'
    console.error(err)
  }
}

onMounted(fetchData)
</script>

<style scoped>
.checkout-container {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 2rem;
  background-color: #f6f9fc;
  min-height: 100vh;
  gap: 3rem;
  flex-wrap: wrap;
}

.product-summary {
  background: #ffffff;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  width: 320px;
  text-align: center;
}

.brand-name {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  margin-bottom: 1rem;
}

.product-title {
  font-size: 1.25rem;
  margin-bottom: 0.5rem;
  color: #111827;
}

.price-label {
  font-size: 1.5rem;
  color: #111;
  margin-bottom: 1.5rem;
}

.product-image {
  max-width: 100%;
  border-radius: 0.75rem;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.payment-form {
  background: #ffffff;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  width: 400px;
}

.payment-form h2 {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 1.25rem;
}

.card-details {
  display: flex;
  gap: 1rem;
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

.pay-button {
  flex: 1;
  width: 100%;
  padding: 0.75rem;
  background-color: #1a202c;
  color: white;
  border: none;
  border-radius: 0.5rem;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.go-back-button:hover {
  background-color: #b38a10;
}

.pay-button:hover {
  background-color: #2d3748;
}

.fee-box {
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 1rem;
  background-color: #eef3e0;
  color: #3b4c14;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  margin-bottom: 1rem;
  font-weight: 500;
  border-left: 4px solid #6b8e23;
}

.product-description {
  font-size: 0.95rem;
  color: #4a5568;
  margin-bottom: 1rem;
}

.seller-info {
  margin-top: 1rem;
  font-size: 0.9rem;
  color: #718096;
  background-color: #f7fafc;
  padding: 0.5rem 0.75rem;
  border-radius: 0.5rem;
  border: 1px solid #e2e8f0;
}

.info-popup {
  position: absolute;
  top: 125%;
  right: 0;
  background-color: white;
  padding: 1rem;
  border-radius: 0.5rem;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  font-size: 0.85rem;
  color: #2d3748;
  width: 350px;
  z-index: 100;
  white-space: normal;
}

.info-container {
  position: relative;
  display: inline-block;
}

.info-icon {
  cursor: pointer;
  font-size: 1.1rem;
  color: #4a5568;
  margin-left: 0.5rem;
  user-select: none;
}
</style>
