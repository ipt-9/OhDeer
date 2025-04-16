<template>
  <nav class="navbar">
    <div class="nav-left">
      <router-link to="/" class="logo">OhDeer</router-link>
      <div class="nav-links">
        <router-link to="/" exact-active-class="active">Home</router-link>
        <router-link to="/shop" exact-active-class="active">Shop</router-link>
        <router-link to="/repairs" exact-active-class="active">Repair Shops</router-link>
      </div>
    </div>

    <div class="nav-center">
      <SearchBar />
    </div>

    <div class="nav-right">
      <div class="auth-buttons" v-if="!isLoggedIn">
        <a href="/login" class="auth-button">Login</a>
        <a href="/register" class="auth-button">Register</a>
      </div>

      <div class="user-dropdown" v-if="isLoggedIn">
        <img :src="user.profileImage" class="profile-img" alt="Profile" />
        <span>{{ user.name }}</span>
          <div class="dropdown-menu-profile">
          <router-link to="/settings">Settings</router-link>
          <a href="#" @click.prevent="logout">Logout</a>
          </div>
        </div>
      </div>
      <div class="user-dropdown" v-if="!isLoggedIn">
        <router-link to="/login">Login</router-link>
      </div>



    <div class="mobile-toggle" @click="toggleMobileMenu()">☰</div>

    <div class="mobile-menu" v-show="mobileMenuOpen">
      <router-link @click="mobileMenuOpen = false" to="/">Home</router-link>
      <router-link @click="mobileMenuOpen = false" to="/shop">Shop</router-link>
      <router-link @click="mobileMenuOpen = false" to="/repairs">Repair Shops</router-link>
      <router-link @click="mobileMenuOpen = false" to="/settings" v-if="isLoggedIn">Settings</router-link>
      <router-link @click="mobileMenuOpen = false" to="/login" v-if="!isLoggedIn">Login</router-link>
      <router-link @click="mobileMenuOpen = false" to="/register" v-if="!isLoggedIn">Register</router-link>
      <a href="#" v-if="isLoggedIn" @click.prevent="logout">Logout</a>
    </div>
  </nav>
</template>
<script>
import SearchBar from './search-bar.vue'

export default {
  name: 'Nav-bar',
  components: { SearchBar },
  data() {
    return {
      mobileMenuOpen: false,
      dropdownOpen: false,
      isLoggedIn: true, //Change later
      user: {
        name: 'Polish Chicken',
        profileImage: 'https://i.redd.it/87kxdlhrk3z71.jpg'
      }
    }
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen
    },
    logout() {
      localStorage.removeItem('token')
      this.isLoggedIn = false
      this.$router.push('/login')
    }
  }
}
</script>
<style>



.navbar {
  overflow: visible;
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  align-items: center;
  background-color: #f4f9f4;
  padding: 1rem 2rem;
  border-bottom: 2px solid #ccc;
  position: sticky;
  top: 0;
  z-index: 1000;
  gap: 1rem;
}

.nav-left {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.logo {
  font-size: 1.6rem;
  font-weight: bold;
  color: #6b8e23;
  text-decoration: none;
  white-space: nowrap;
}
.logo:hover {
  color: #556b2f;
}

.nav-links {
  display: flex;
  gap: 1rem;
}
.nav-links a {
  text-decoration: none;
  color: #333;
  font-weight: 500;
  padding: 0.2rem 0.3rem;
  transition: color 0.3s;
  min-width: 60px;
  text-align: center;
}
.nav-links a:hover,
.nav-links a.active {
  color: #6b8e23;
  font-weight: bold;
}

.nav-center {
  position: relative;
  overflow: visible;
  display: flex;
  justify-content: center;
  align-items: center;
}


.nav-right {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 1rem;
}

.auth-button {
  color: #6b8e23;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s;
}
.auth-button:hover {
  color: #556b2f;
}

.user-dropdown {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  position: relative;
}
.profile-img {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 1px solid #ccc;
}
.dropdown-menu {
  position: absolute;
  top: calc(100% + 4px);
  left: 0;
  min-width: 250px;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 1rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 10;
}
.dropdown-menu-profile {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 0.5rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  flex-direction: column;
  min-width: 140px;
  z-index: 1000;
}

.user-dropdown:hover .dropdown-menu-profile {
  display: flex;
}

.dropdown-menu-profile a {
  color: #333;
  text-decoration: none;
  padding: 0.4rem 0.6rem;
  transition: background-color 0.2s;
}

.dropdown-menu-profile a:hover {
  background-color: #f0f0f0;
}

.user-dropdown:hover .dropdown-menu {
  display: flex;
}
.dropdown-menu a {
  color: #333;
  text-decoration: none;
  padding: 0.4rem 0.6rem;
  transition: background-color 0.2s;
}
.dropdown-menu a:hover {
  background-color: #f0f0f0;
}

.mobile-toggle {
  display: none;
  font-size: 1.8rem;
  cursor: pointer;
}

.mobile-menu {
  display: none;
  flex-direction: column;
  background-color: #ffffff;
  padding: 1rem;
  border-top: 1px solid #ccc;
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  z-index: 999;
}
.mobile-menu.open {
  display: flex;
}
.mobile-menu a {
  padding: 0.5rem;
  text-decoration: none;
  color: #333;
  font-weight: 500;
}
.mobile-menu a:hover {
  background-color: #f4f4f4;
}

@media (max-width: 768px) {
  .nav-links,
  .nav-center,
  .nav-right {
    display: none;
  }

  .mobile-toggle {
    display: block;
  }

  .mobile-menu {
    display: flex;
  }
}.dropdown-menu label {
  cursor: pointer;
  padding: 0.3rem 0.5rem;
  border-radius: 4px;
  transition: background-color 0.2s;
}
.dropdown-menu label:hover {
  background-color: #f5f5f5;
}

</style>
