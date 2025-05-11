<template>
  <div class="settings-container">
    <navBar />
    <div class="settings-content">
      <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
          <li :class="{ active: activeTab === 'settings' }" @click="activeTab = 'settings'">Settings</li>
          <li :class="{ active: activeTab === 'listings' }" @click="activeTab = 'listings'">Listings</li>
        </ul>
      </div>

      <div class="content">
        <div v-if="activeTab === 'settings'">
          <h3>Settings</h3>
          <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
          <p v-if="successMessage" class="success">{{ successMessage }}</p>
          <form @submit.prevent="updateSettings">
            <label>Username: <input v-model="username" /></label>
            <label>Email: <input v-model="email" type="email" /></label>
            <label>Profile Image Link: <input v-model="profileImage" type="text" /></label>
            <label>Language:
              <select v-model="language">
                <option value="en">English</option>
              </select>
            </label>
            <label>Address: <input v-model="address" /></label>
            <label>Postal Code: <input v-model.number="postalCode" type="number" /></label>
            <label>Website: <input v-model="website" type="text" /></label>
            <button type="submit">Save Changes</button>
          </form>
        </div>

        <div v-if="activeTab === 'listings'">
          <h3>Your Listings</h3>
          <p v-if="loading" class="loading">Loading...</p>
          <p v-if="!loading && userListings.length === 0" class="no-listings">No listings found.</p>

          <div v-if="!loading" class="listings-grid">
            <router-link 
              v-for="listing in userListings" 
              :key="listing.id" 
              :to="{ path: `/inspectitem/${listing.id}` }"
              class="listing-card-link"
            >
              <div 
                :class="['listing-card', listing.is_complete ? 'closed' : 'active']"
              >
                <img :src="listing.image_1" alt="Listing Image" class="listing-image" />
                <h4>{{ listing.title }}</h4>
                <p>{{ listing.description }}</p>
                <p class="price">CHF {{ listing.price }}</p>
                <p :class="listing.is_complete ? 'status-closed' : 'status-active'">
                  {{ listing.is_complete ? 'Closed' : 'Active' }}
                </p>
                <button class="inspect-button">Inspect</button>
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



  
<script setup>
import { ref, onMounted } from 'vue';
import navBar from "./nav-bar.vue";

const activeTab = ref('settings');

const username = ref('');
const email = ref('');
const language = ref('en');
const address = ref('');
const postalCode = ref('');
const profileImage = ref('');
const userId = ref('');
const website = ref('');
const errorMessage = ref('');
const successMessage = ref('');
const userListings = ref([]);
const loading = ref(true);

async function fetchUserDetails() {
  try {
    const token = localStorage.getItem('token');
    if (!token) throw new Error('User not authenticated');

    const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/users/user', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) throw new Error('Failed to fetch user data');

    const data = await response.json();
    username.value = data.username || '';
    email.value = data.email || '';
    address.value = data.address || '';
    postalCode.value = data.postal_code || '';
    language.value = data.language || '';
    profileImage.value = data.profile_image || '';
    website.value = data.website || '';
    userId.value = data.id || '';

    await fetchUserListings();
  } catch (err) {
    errorMessage.value = 'Error fetching user data: ' + err.message;
  }
}

async function fetchUserListings() {
  try {
    const token = localStorage.getItem('token');
    if (!token) throw new Error('User not authenticated');

    if (!userId.value) await fetchUserDetails();

    const response = await fetch(`https://api.ohdeer-bmsd22a.bbzwinf.ch/api/users/${userId.value}/posts`, {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) throw new Error('Failed to fetch listings');

    const data = await response.json();
    userListings.value = data;
  } catch (err) {
    errorMessage.value = 'Error fetching listings: ' + err.message;
  } finally {
    loading.value = false;
  }
}

async function updateSettings() {
  try {
    const token = localStorage.getItem('token');
    if (!token) throw new Error('User not authenticated');

    const updateData = {
      name: username.value,
      email: email.value,
      language: language.value,
      address: address.value,
      postal_code: postalCode.value,
      profile_image: profileImage.value,
      website: website.value
    };

    const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/users/update', {
      method: 'PUT',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(updateData),
    });

    if (!response.ok) throw new Error('Failed to update settings');

    successMessage.value = 'Settings updated successfully!';
  } catch (err) {
    errorMessage.value = 'Error updating settings: ' + err.message;
  }
}

onMounted(() => {
  fetchUserDetails();
});
</script>

<style scoped>
.settings-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.settings-content {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  margin-top: 10px;
}

.sidebar {
  flex: 0 0 200px;
  background-color: #f4f4f4;
  padding: 1rem;
  border-radius: 8px;
}

.sidebar h2 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
}

.sidebar li {
  padding: 0.5rem;
  margin: 0.3rem 0;
  background-color: #e0e0e0;
  border-radius: 4px;
  cursor: pointer;
}

.sidebar li:hover, .sidebar li.active {
  background-color: #d0d0d0;
}

.content {
  flex: 1;
  padding: 1rem;
  background-color: #ffffff;
  border-radius: 8px;
}

form {
  display: flex;
  flex-direction: column;
  gap: 0.8rem;
}

input, select {
  padding: 0.5rem;
  margin-top: 0.2rem;
  border-radius: 4px;
  border: 1px solid #ccc;
  width: 100%;
}

button {
  margin-top: 1rem;
  padding: 0.6rem 1.2rem;
  background-color: #388659;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

button:hover {
  background-color: #2c6a4e;
}
.loading, .no-listings {
  text-align: center;
  color: #666;
  margin: 1rem 0;
  font-style: italic;
}

.listings-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  justify-items: center;
}

.listing-card {
  background-color: #ffffff;
  padding: 1rem;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s;
  text-align: center;
}

.listing-card.active {
  border-left: 5px solid #007bff;
}

.listing-card.closed {
  border-left: 5px solid #dc3545;
}

.listing-image {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 0.5rem;
}

.inspect-button {
  margin-top: 0.5rem;
  padding: 0.4rem 1rem;
  background-color: #388659;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.inspect-button:hover {
  background-color: #2c6a4e;
}

@media (max-width: 768px) {
  .settings-content {
    flex-direction: column;
  }
  .sidebar {
    width: 100%;
  }
  .listings-grid {
  grid-template-columns: 1fr;
  }
}


</style>