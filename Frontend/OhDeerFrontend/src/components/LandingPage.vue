<script setup>
import navBar from "./nav-bar.vue";
import { ref, computed, onMounted } from "vue";
import slugify from "slugify";

const isLoggedIn = ref(false);
const userPostalCode = ref("");
const shopItems = ref([]);
const nonRepairItems = ref([]);
const repairItems = ref([]);
const newArrivals = ref([]);
const images = ref([]);
const slideFilter = ref("all");
const currentIndex = ref(0);
const errorMessage = ref("");

onMounted(async () => {
  const token = localStorage.getItem("token");
  isLoggedIn.value = !!token;

  if (isLoggedIn.value) {
    await fetchUserDetails(token);
  }

  await fetchItems();
});



const slides = [
  {
    title: 'Shop the Latest Furniture Collection',
    description: 'Discover stylish and affordable furniture pieces for every room.',
    image: 'https://blog.meyerhatchery.com/wp-content/uploads/2022/06/Main-Blog-Images-Always-1200x____-6-1.png',
    link: '/marketplace',
    buttonText: 'Shop Now'
  },
  {
    title: 'Find Trusted Repair Services',
    description: 'Get your items fixed by verified repair shops near you.',
    image: 'https://blog.meyerhatchery.com/wp-content/uploads/2022/06/Main-Blog-Images-Always-1200x____-6-1.png',
    link: '/repairlistings',
    buttonText: 'Find Repairs'
  },
  {
    title: 'Sell Your Items Quickly and Easily',
    description: 'List your items and connect with local buyers today.',
    image: 'https://blog.meyerhatchery.com/wp-content/uploads/2022/06/Main-Blog-Images-Always-1200x____-6-1.png',
    link: '/create-listing',
    buttonText: 'Start Selling'
  },
  {
    title: 'Explore Our New Arrivals',
    description: 'Check out the latest additions to our marketplace.',
    image: 'https://blog.meyerhatchery.com/wp-content/uploads/2022/06/Main-Blog-Images-Always-1200x____-6-1.png',
    link: '/marketplace',
    buttonText: 'View Now'
  },
];



const truncate = (text, maxLength) => {
  return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
};

async function fetchUserDetails(token) {
  try {
    const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/users/user', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) throw new Error('Failed to fetch user data');
    const data = await response.json();
    userPostalCode.value = data.postal_code;
  } catch (err) {
    errorMessage.value = 'Error fetching user data: ' + err.message;
    console.error(err);
  }
}

async function fetchItems() {
  try {
    const response = await fetch('https://api.ohdeer-bmsd22a.bbzwinf.ch/api/posts/all', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) throw new Error('Failed to fetch items');
    const data = await response.json();

   
    shopItems.value = data
      .filter(item => !item.is_complete) 
      .sort((a, b) => new Date(b.created_at) - new Date(a.created_at)) 
      .map(item => ({
        id: item.id,
        is_repair: item.is_repair,
        title: item.title,
        link: slugify(item.title),
        description: item.description,
        price: item.price,
        image: item.image_1 || 'https://api.ohdeer-bmsd22a.bbzwinf.ch/OhDeerPlaceholder.png',
        address: item.address || 'No address',
        postalCode: item.postal_code || 'No postal code',
        phone: item.phone_number || 'No phone number',
        created_at: item.created_at,
      }));

    nonRepairItems.value = shopItems.value.filter(item => !item.is_repair);
    repairItems.value = shopItems.value.filter(item => item.is_repair);
    newArrivals.value = shopItems.value.slice(0, 5);

    images.value = newArrivals.value.map(item => ({
      src: item.image,
      url: `/inspectitem/${slugify(item.title)}-${item.id}`,
    }));
  } catch (err) {
    errorMessage.value = 'Error fetching items: ' + err.message;
    console.error(err);
  }
}

const prevSlide = () => {
  currentIndex.value = (currentIndex.value - 1 + slides.length) % slides.length;
};

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % slides.length;
};

</script>
<template>
  <div class="container">
    <navBar />

    <div class="slideshow">
  <div 
    v-for="(slide, index) in slides" 
    :key="index" 
    class="slide" 
    :style="{ backgroundImage: `url(${slide.image})` }"
    v-show="index === currentIndex"
  >
    <div class="slide-content">
      <h2 class="slide-title">{{ truncate(slide.title, 40) }}</h2>
      <p class="slide-desc">{{ truncate(slide.description, 100) }}</p>
      <router-link :to="slide.link">
        <button class="slide-button">{{ slide.buttonText }}</button>
      </router-link>
    </div>
  </div>
  <button class="arrow left" @click="prevSlide">&#9664;</button>
  <button class="arrow right" @click="nextSlide">&#9654;</button>
</div>

    <button class="arrow left" @click="prevSlide">&#9664;</button>
    <button class="arrow right" @click="nextSlide">&#9654;</button>
  </div>
    <p v-if="errorMessage" class="error">{{ errorMessage }}</p>

    <div class="shopComponent">
    <h3>Categories</h3>
    <div class="categoryGrid">
      <router-link
        v-for="category in ['Electronics', 'Furniture', 'Appliances', 'Services']"
        :key="category"
        :to="`/search-results?categories=${category.toLowerCase()}`"
        class="categoryCard"
      >
        {{ category }}
      </router-link>
    </div>
  </div>

    <div class="shopComponent">
      <h3>Newest Items Near You</h3>
      <div class="shopGrid">
        <div v-for="item in newArrivals" :key="item.id" class="shopCard">
          <img :src="item.image" alt="Product Image" class="productImage" />
          <h4>{{ item.title }}</h4>
          <p>{{ item.description }}</p>
          <p class="price">CHF {{ item.price }}</p>
        </div>
      </div>
    </div>

    <div class="shopComponent">
      <h3>Repair Shops Near You</h3>
      <div class="shopGrid">
        <div v-for="shop in repairItems" :key="shop.id" class="shopCard">
          <img :src="shop.image" alt="Shop Image" class="productImage" />
          <h4>{{ shop.title }}</h4>
          <p>{{ shop.description }}</p>
          <p class="price">CHF {{ shop.price }}</p>
        </div>
      </div>
    </div>

</template>
<style scoped>
.container {
  margin: 0;
  padding: 0;
  font-family: 'Poppins', sans-serif;
}
.slideshow {
  position: relative;
  width: 100%;
  max-height: 400px;
  overflow: hidden;
  border-radius: 10px;
}

.slide {
  position: relative;
  width: 100%;
  height: 400px;
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}

.slide-content {
  background-color: rgba(0, 0, 0, 0.5);
  padding: 1.5rem;
  border-radius: 8px;
  text-align: center;
}

.slide-title {
  font-size: 1.8rem;
  margin-bottom: 0.5rem;
  font-weight: bold;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.slide-desc {
  font-size: 1rem;
  margin-bottom: 1rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.slide-button {
  background-color: #388659;
  color: white;
  border: none;
  padding: 0.5rem 1.5rem;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1rem;
  transition: background-color 0.3s;
}

.slide-button:hover {
  background-color: #2d6a4f;
}

.arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 0.5rem;
  cursor: pointer;
  font-size: 1.5rem;
  border-radius: 50%;
}

.arrow.left {
  left: 15px;
}

.arrow.right {
  right: 15px;
}

.arrow:hover {
  background: rgba(0, 0, 0, 0.8);
}

.arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
}

.arrow.left {
  left: 10px;
}

.arrow.right {
  right: 10px;
}

.shopComponent {
  padding: 20px;
  margin: 10px;
  background: #f4f4f4;
  border-radius: 8px;
}

.shopGrid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 10px;
}

.shopCard {
  background: white;
  padding: 10px;
  border-radius: 8px;
}

.categoryGrid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
  gap: 10px;
}

.categoryCard {
  background: #ddd;
  padding: 10px;
  text-align: center;
  border-radius: 8px;
  text-decoration: none;
  color: black;
  font-weight: bold;
  transition: transform 0.2s;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.categoryCard:hover {
  transform: scale(1.05);
  background: #c4c4c4;
}

.shopCard h4, .shopCard p {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.productImage {
  width: 100%;
  height: auto;
  max-height: 300px; 
  object-fit: contain;
  border-radius: 12px;
}


.shopCard, .categoryCard {
  max-width: 300px; 
}

@media (max-width: 768px) {
  .productImage, .slide {
    max-height: 200px;
  }

  .shopCard, .categoryCard {
    max-width: 100%;
  }
}
</style>
