<template>
  <div class="slideshow">
    <a :href="images[currentIndex].url" target="_blank">
      <img :src="images[currentIndex].src" class="slide" alt="Slideshow Image" />
    </a>
    <button class="arrow left" @click="prevSlide">&#9664;</button>
    <button class="arrow right" @click="nextSlide">&#9654;</button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const images = ref([
  { src: 'https://cdn-images-1.medium.com/max/1600/1*bzScNScXnXNvjg-Ak70EHA.jpeg', url: 'https://example.com/1' },
  { src: 'https://dornob.com/wp-content/uploads/2009/04/plywood02_1000.jpg', url: 'https://example.com/2' },
  { src: 'https://www.gen-pack.com/wp-content/uploads/2021/04/Rework-_-Repair-Button-212287633-768x509.jpg', url: 'https://example.com/3' }
]);

const currentIndex = ref(0);

const prevSlide = () => {
  currentIndex.value = (currentIndex.value - 1 + images.value.length) % images.value.length;
};

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % images.value.length;
};
</script>

<style scoped>
.slideshow {
  position: relative;
  width: 800px;
  height: 400px;
  margin: auto;
  overflow: hidden;
}

.slide {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.3);
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 24px;
  transition: background 0.3s;
}

.arrow.left {
  left: 10px;
}

.arrow.right {
  right: 10px;
}

.arrow:hover {
  background: rgba(0, 0, 0, 0.6);
}
</style>
