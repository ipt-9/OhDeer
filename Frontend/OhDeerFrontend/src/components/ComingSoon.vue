<template>
  <div class="coming-soon-wrapper">
    <div class="message-container">
      <h1>Coming Soon</h1>
      <p>We're working hard to bring you something amazing. Stay tuned!</p>
      <p class="small">Check back again later!</p>
      <button @click="goBack">Go Back</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ComingSoonPage',
  methods: {
    goBack() {
      this.$router.go(-1);
    }
  }
};
</script>

<style scoped>
.coming-soon-wrapper {
  height: 100vh;
  width: 100%;
  background-image: url("https://www.wallart.com/media/catalog/product/cache/871f459736130e239a3f5e6472128962/w/o/wo3769-small.jpg");
  background-size: cover;
  background-position: center;
  display: flex;
  justify-content: center;
  align-items: center;
}

.message-container {
  background-color: rgba(255, 255, 255, 0.85);
  padding: 2rem 3rem;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  text-align: center;
  max-width: 400px;
}

h1 {
  margin-bottom: 1rem;
  font-size: 2.2rem;
  color: #333;
}

p {
  font-size: 1rem;
  color: #555;
  margin: 0.5rem 0;
}

.small {
  font-size: 0.85rem;
  color: #777;
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
</style>