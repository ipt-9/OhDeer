<template>
    <div class="settings-container">
      <navBar />
      <div class="settings-content">
        <div class="sidebar">
          <h2>Dashboard</h2>
          <ul>
            <li :class="{ active: activeTab === 'settings' }" @click="activeTab = 'settings'">Settings</li>
            <li :class="{ active: activeTab === 'listings' }" @click="activeTab = 'listings'">Listings</li>
            <li :class="{ active: activeTab === 'subscriptions' }" @click="activeTab = 'subscriptions'">Subscriptions</li>
          </ul>
        </div>
  
        <div class="content">
          <div v-if="activeTab === 'settings'">
            <h3>Settings</h3>
            <form @submit.prevent="updateSettings">
              <label>Username: <input v-model="username" /></label>
              <label>Email: <input v-model="email" type="email" /></label>
              <label>Password: <input v-model="password" type="password" /></label>
              <label>Language:
                <select v-model="language">
                  <option value="en">English</option>
                  <option value="de">German</option>
                  <option value="fr">French</option>
                </select>
              </label>
              <label>Address: <input v-model="address" /></label>
              <label>Postal Code: <input v-model.number="postalCode" type="number" /></label>
              <button type="submit">Save Changes</button>
            </form>
          </div>
  
          <div v-if="activeTab === 'listings'">
            <h3>Your Listings</h3>
            <p>Manage your active and past listings here.</p>
          </div>
  
          <div v-if="activeTab === 'subscriptions'">
            <h3>Subscriptions</h3>
            <p>Manage your subscription plan and payments here.</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import navBar from "./nav-bar.vue";
  
  const activeTab = ref('settings');
  
  const username = ref('');
  const email = ref('');
  const password = ref('');
  const language = ref('en');
  const address = ref('');
  const postalCode = ref('');
  
  function updateSettings() {
    console.log('Settings updated:', { username: username.value, email: email.value, password: password.value, language: language.value, address: address.value, postalCode: postalCode.value });
  }
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
  
  @media (max-width: 768px) {
    .settings-content {
      flex-direction: column;
    }
    .sidebar {
      width: 100%;
    }
  }
  </style>
  