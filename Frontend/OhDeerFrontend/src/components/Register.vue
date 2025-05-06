<template>
  <div class="register-wrapper">
    <div class="form-container">
      <h2>Register</h2>
      <form @submit.prevent="handleRegister">
        <input type="text" v-model="username" placeholder="Username" />
        <input type="email" v-model="email" placeholder="Email" />
        <input type="password" v-model="password" placeholder="Password" @input="checkStrength" />
        <p class="strength">Password strength: {{ passwordStrength }}</p>
        <input type="password" v-model="confirmPassword" placeholder="Confirm Password" />
        <input type="text" v-model="address" placeholder="Address" />
        <input type="text" v-model="postalCode" placeholder="Postal Code" />
        <p v-if="error" class="error">{{ error }}</p>
        <button type="submit">Register</button>
      </form>
      <router-link to="/login" class="link">Already have an account? Login</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RegisterPage',
  data() {
    return {
      username: '',
      email: '',
      password: '',
      confirmPassword: '',
      address: '',
      postalCode: '',
      error: '',
      passwordStrength: 'Weak',
    }
  },
  methods: {
    checkStrength() {
      const length = this.password.length
      const hasUpper = /[A-Z]/.test(this.password)
      const hasLower = /[a-z]/.test(this.password)
      const hasNumber = /[0-9]/.test(this.password)
      const hasSpecial = /[^A-Za-z0-9]/.test(this.password)
      const commonPatterns = /(123|password|abc)/i.test(this.password)

      if (length >= 10 && hasUpper && hasLower && hasNumber && hasSpecial && !commonPatterns) {
        this.passwordStrength = 'Strong'
      } else if (length >= 8 && hasUpper && hasLower && hasNumber && hasSpecial) {
        this.passwordStrength = 'Medium'
      } else {
        this.passwordStrength = 'Weak'
      }
    },

    async handleRegister() {
      this.error = ''

      if (
        !this.username ||
        !this.email ||
        !this.password ||
        !this.confirmPassword ||
        !this.address ||
        !this.postalCode
      ) {
        this.error = 'Please fill in all fields.'
        return
      }

      if (this.password !== this.confirmPassword) {
        this.error = 'Passwords do not match.'
        return
      }

      if (this.passwordStrength === 'Weak') {
        this.error = 'Password is too weak, please input at least 8 characters.'
        return
      }

      try {
        const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/users/register', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
          },
          body: JSON.stringify({
            username: this.username,
            email: this.email,
            password: this.password,
            address: this.address,
            postal_code: this.postalCode,
          }),
        })

        const data = await response.json()

        if (!response.ok) {
          this.error = data.message || 'Registration failed.'
          return
        }
        if (data.token) {
          localStorage.setItem('token', data.token)
        }

        alert('Registration successful!')
        this.$router.push('/login')
      } catch (err) {
        this.error = 'An error occurred. Please try again.'
        console.error(err)
      }
    },
  },
}
</script>

<style scoped>
.register-wrapper {
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
  margin: 0.75rem 0;
  padding: 0.5rem;
  border-radius: 6px;
  border: 1px solid #ccc;
}

input:focus {
  outline: none;
  border-color: #3e5732;
  box-shadow: 0 0 5px rgba(62, 87, 50, 0.5);
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
  margin-top: 1rem;
}

button:hover {
  background-color: #556b2f;
}

.error {
  color: red;
  font-size: 0.9em;
  margin-bottom: 0.5rem;
}

.strength {
  text-align: left;
  font-size: 0.8em;
  color: #3e5732;
  margin-bottom: 0.5rem;
}

.link {
  display: block;
  margin-top: 1rem;
  color: #3e5732;
  font-size: 0.9rem;
  text-decoration: none;
}

.link:hover {
  text-decoration: underline;
}
</style>
