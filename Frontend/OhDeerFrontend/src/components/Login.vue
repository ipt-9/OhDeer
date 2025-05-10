<template>
  <div class="login-wrapper">
    <div class="form-container">
      <h2>Login</h2>
      <form @submit.prevent="handleLogin">
        <input type="text" v-model="email" placeholder="Email" />
        <input type="password" v-model="password" placeholder="Password" />
        <p v-if="error" class="error">{{ error }}</p>
        <button type="submit">Login</button>
      </form>
      <router-link to="/register">Don't have an account? Register</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoginPage',
  data() {
    return {
      email: '',
      password: '',
      error: '',
    }
  },

  methods: {
    async handleLogin() {
      this.error = ''

      if (!this.email || !this.password) {
        this.error = "Please fill in all fields."
        return
      }

      try {
        const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/auth/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
          },
          body: JSON.stringify({
            email: this.email,
            password: this.password,
          }),
        })

        const data = await response.json()

      if (!response.ok) {
        this.error = data.message || 'Login failed.';
        return;
      }
      const user = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/users/user', {
        method: 'GET',

      })
      localStorage.setItem('token', data.token);
      localStorage.setItem('user', JSON.stringify())
      this.$router.push('/');

    } catch (err) {
      this.error = 'An error occurred. Please try again.';
      console.error(err);
    }
  }
}
}
</script>

<style scoped>
.login-wrapper {
  height: 100vh;
  width: 100%;
  background-image: url('https://wallpaperaccess.com/full/3625325.jpg');
  background-size: cover;
  background-position: center;
  display: flex;
  justify-content: center;
  align-items: center;
}

.form-container {
  background-color: rgba(255, 255, 255, 0.85);
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  width: 300px;
  text-align: center;
}

input {
  display: block;
  width: 100%;
  margin: 1rem 0;
  padding: 0.5rem;
  border-radius: 6px;
  border: 1px solid #ccc;
}

button {
  width: 100%;
  padding: 0.5rem;
  background-color: #6b8e23;
  color: white;
  border: none;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
}

button:hover {
  background-color: #556b2f;
}

.error {
  color: red;
  font-size: 0.9em;
}
</style>
