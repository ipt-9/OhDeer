<template>
  <nav class="navbar">
    <div class="nav-left">
      <router-link to="/" class="logo">OhDeer</router-link>
      <div class="nav-links">
        <router-link to="/" exact-active-class="active">Home</router-link>
        <router-link to="/marketplace" exact-active-class="active">Marketplace</router-link>
        <router-link to="/repairlistings" exact-active-class="active">Repair Shops</router-link>
        <router-link to="/create-listing" exact-active-class="active">Create Listing</router-link>
      </div>
    </div>

    <div class="nav-center desktop-search">
      <SearchBar />
    </div>

    <div class="nav-right">
      <div class="auth-buttons" v-if="!isLoggedIn">
        <router-link to="/login" exact-active-class="active" class="auth-link">Login</router-link>
        <span class="separator">|</span>
        <router-link to="/register" exact-active-class="active" class="auth-link"
          >Register</router-link
        >
      </div>

      <div class="user-dropdown" v-if="isLoggedIn">
        <router-link :to="'/profile/' + user.id" exact-active-class="active" class="auth-link">
          <img :src="user.profileImage" class="profile-img" alt="Profile" />
          <span class="user-name">{{ user.name }}</span>
        </router-link>
        <div class="dropdown-menu-profile">
          <router-link to="/settings">Settings</router-link>
          <a href="#" @click.prevent="logout">Logout</a>
        </div>
      </div>
    </div>

    <div class="mobile-toggle" @click="toggleMobileMenu()">☰</div>

    <div class="mobile-menu" v-show="mobileMenuOpen">
      <div class="mobile-search">
        <SearchBar />
      </div>
      <router-link @click="mobileMenuOpen = false" to="/">Home</router-link>
      <router-link @click="mobileMenuOpen = false" to="/marketplace">Marketplace</router-link>
      <router-link @click="mobileMenuOpen = false" to="/repairlistings">Repair Shops</router-link>
      <router-link @click="mobileMenuOpen = false" to="/create-listing">Create Listing</router-link>
      <router-link @click="mobileMenuOpen = false" to="/settings" v-if="isLoggedIn"
        >Settings</router-link
      >
      <router-link @click="mobileMenuOpen = false" to="/login" v-if="!isLoggedIn"
        >Login</router-link
      >
      <router-link @click="mobileMenuOpen = false" to="/register" v-if="!isLoggedIn"
        >Register</router-link
      >
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
      errorMessage: '',
      user: {
        id: 0,
        name: 'User',
        profileImage: 'https://i.redd.it/87kxdlhrk3z71.jpg',
      },
      isLoggedIn: false,
    }
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen
    },
    async fetchUserDetails() {
      try {
        const token = localStorage.getItem('token')
        if (!token) {
          this.isLoggedIn = false
          return
        }

        const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/users/user', {
          method: 'GET',
          headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json',
            Accept: 'application/json'
          },
        })

        if (!response.ok) throw new Error('Failed to fetch user data')

        const data = await response.json()

        this.user.name = data.username ? data.username : 'User'
        this.user.id = data.id ? data.id : 0
        this.isLoggedIn = true

        if (data.profile_image && data.profile_image.startsWith('http')) {
          this.user.profileImage = data.profile_image
        } else if (data.profile_image) {
          this.user.profileImage = `https://api.ohdeer-bmsd22a.bbzwinf.ch/${data.profile_image}`
        } else {
          this.user.profileImage = 'https://i.redd.it/87kxdlhrk3z71.jpg'
        }

        console.log('User fetched:', this.user)
      } catch (err) {
        console.error('Error fetching user data:', err)
        this.isLoggedIn = false
      }
    },
    async logout() {
      try {
        const token = localStorage.getItem('token')
        if (!token) return

        const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/auth/logout', {
          method: 'POST',
          headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json',
          },
        })

        if (!response.ok) {
          console.error('Logout failed')
          return
        }

        localStorage.removeItem('token')
        this.isLoggedIn = false
        this.user = { name: 'User', profileImage: 'https://i.redd.it/87kxdlhrk3z71.jpg' }
        this.$router.push('/login')
      } catch (err) {
        console.error('Error during logout:', err)
      }
    },
  },
  mounted() {
    const token = localStorage.getItem('token')
    if (token) {
      this.isLoggedIn = true
      this.fetchUserDetails()
    } else {
      this.isLoggedIn = false
    }
  },
}
</script>

<style>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f4f9f4;
  padding: 1rem 2rem;
  border-bottom: 2px solid #ccc;
  position: sticky;
  top: 0;
  z-index: 1000;
}
.auth-link {
  text-decoration: none;
  color: #6b8e23;
  margin: 0 0.5rem;
  font-weight: bold;
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
  margin-right: 0.5rem;
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

.desktop-search {
  display: block;
}
.dropdown-menu-profile {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  background-color: white;
  padding: 0.5rem;
  border-radius: 6px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
  .nav-links a,
  .auth-link {
    text-decoration: none;
    color: #333;
    padding: 0.3rem;
  }
  .desktop-search {
    display: none;
  }
  .navbar {
    flex-direction: column;
  }
  .nav-links a:hover,
  .auth-link:hover {
    color: #6b8e23;
  }
  .nav-center {
    display: none;
  }
  .navbar {
    flex-direction: column;
  }

  .nav-right {
    margin-top: 0.5rem;
  }

  .user-dropdown {
    display: flex;
    align-items: center;
    cursor: pointer;
  }

  .user-dropdown:hover {
    display: flex;
  }

  .dropdown-menu-profile {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: white;
    padding: 0.5rem;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .mobile-toggle {
    display: block;
    font-size: 1.8rem;
    cursor: pointer;
  }

  .mobile-menu {
    display: flex;
  }
  .mobile-menu a:hover {
    background-color: #f4f4f4;
  }

  .mobile-search {
    display: block;
    margin: 0.5rem 0;
  }
}
.dropdown-menu label {
  cursor: pointer;
  padding: 0.3rem 0.5rem;
  border-radius: 4px;
  transition: background-color 0.2s;
}
.dropdown-menu label:hover {
  background-color: #f5f5f5;
}
.separator {
  margin: 0 0.5rem;
  color: #999;
}
.user-name {
  margin-left: 0.5rem;
  font-weight: bold;
}
</style>
