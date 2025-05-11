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
const categories = [
  { id: 1, name: 'Furniture & Home Items' },
  { id: 2, name: 'Electronics' },
  { id: 3, name: 'Household Appliances' },
  { id: 4, name: 'Clothing & Accessories' },
  { id: 5, name: 'Vehicles & Mobility' },
  { id: 6, name: 'Luxury & Accessories' },
  { id: 7, name: 'Toys & Hobby Items' },
  { id: 8, name: 'Services' },
  { id: 9, name: 'Automotive' },
  { id: 10, name: 'Other' }
];
const handleScroll = (event, carouselId) => {
  const carousel = document.getElementById(carouselId);
  if (carousel) {
    carousel.scrollBy({ left: event.deltaY, behavior: 'smooth' });
  }
};

onMounted(async () => {
  const token = localStorage.getItem("token");
  isLoggedIn.value = !!token;

  if (isLoggedIn.value) {
    await fetchUserDetails(token);
  }

  await fetchItems();
  const itemCarousel = document.getElementById('item-carousel');
  const repairCarousel = document.getElementById('repair-carousel');

  if (itemCarousel) {
    itemCarousel.addEventListener('wheel', (event) => handleScroll(event, 'item-carousel'));
  }

  if (repairCarousel) {
    repairCarousel.addEventListener('wheel', (event) => handleScroll(event, 'repair-carousel'));
  }
});

const scrollLeft = (carouselId) => {
  const carousel = document.getElementById(carouselId);
  carousel.scrollBy({ left: -300, behavior: 'smooth' });
};

const scrollRight = (carouselId) => {
  const carousel = document.getElementById(carouselId);
  carousel.scrollBy({ left: 300, behavior: 'smooth' });
};


const slides = [
  {
    title: 'Shop the Latest Furniture Collection',
    description: 'Discover stylish and affordable furniture pieces for every room.',
    image: 'https://images.pexels.com/photos/45175/hirsch-forest-wild-fallow-deer-45175.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
    link: '/marketplace',
    buttonText: 'Shop Now'
  },
  {
    title: 'Find Trusted Repair Services',
    description: 'Get your items fixed by verified repair shops near you.',
    image: 'https://images.pexels.com/photos/3329812/pexels-photo-3329812.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
    link: '/repairlistings',
    buttonText: 'Find Repairs'
  },
  {
    title: 'Sell Your Items Quickly and Easily',
    description: 'List your items and connect with local buyers today.',
    image: 'https://images.pexels.com/photos/682373/pexels-photo-682373.jpeg?cs=srgb&dl=pexels-steve-130217-682373.jpg&fm=jpg',
    link: '/create-listing',
    buttonText: 'Start Selling'
  },
  {
    title: 'Explore Our New Arrivals',
    description: 'Check out the latest additions to our marketplace.',
    image: 'https://images.pexels.com/photos/735987/pexels-photo-735987.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
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
    <div class="category-nav">
      <div class="category-scroll">
        <router-link
          v-for="(category, index) in categories"
          :key="index"
          :to="`/search-results?category=${category.id}`"
          class="category-link"
        >
          {{ category.name }}
        </router-link>
      </div>
    </div>

    <div class="shopComponent">
      <h3>Items Near You</h3>
      <div class="carousel-wrapper">
        <div class="carousel" id="item-carousel">
          <div v-for="item in nonRepairItems" :key="item.id" class="shopCard">
            <img :src="item.image" alt="Product Image" class="productImage" />
            <h4 class="title" style="padding-bottom: 30px;">{{ item.title }}</h4>
            <div class="infoGridItem">
              <p class="desc">{{ item.description }}</p>
              <p class="price">CHF {{ item.price }}</p>
              <router-link :to="{ path: `/inspectitem/${slugify(item.title)}`, query: { id: item.id } }">
                <button class="but">More Information</button>
              </router-link>
            </div>  
          </div>
        </div>
      </div>
    </div>

    <div class="shopComponent">
    <h3>Repair Shops Near You</h3>
    <div class="carousel-wrapper">
      <div class="carousel" id="repair-carousel">
        <div v-for="shop in repairItems" :key="shop.id" class="shopCard">
          <img :src="shop.image" alt="Shop Image" class="productImage" />
          <h4 class="title" style="padding-bottom: 30px;">{{ shop.title }}</h4>
          <p class="descShop" style="padding-bottom: 40px;">{{ shop.description }}</p>
          <div class="button-center">
            <router-link :to="{ path: `/inspectrepair/${slugify(shop.title)}`, query: { id: shop.id } }">
              <button class="butShop">More Information</button>
            </router-link>
          </div>
        </div>
      </div>
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

.button-center {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

.butShop {
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: white;
  border: none;
  padding: 10px 16px;
  margin-top: 10px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  transition: 0.3s ease;
  align-items: center;
}

.butShop:hover {
  background: linear-gradient(135deg, #0056b3, #00448a);
}

.slide-button:hover {
  background-color: #2d6a4f;
}

.arrow {
  position: absolute;
  top: 47.5%;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding-top: 0.2rem;
  padding-bottom: 0.4rem;
  cursor: pointer;
  font-size: 1.5rem;
  border-radius: 50%;
  text-align: center;
}

.arrow.left {
  left: 15px;
  padding-left: 0.3rem;
  padding-right: 0.5rem;
}

.arrow.right {
  right: 15px;
  padding-left: 0.5rem;
  padding-right: 0.3rem;
}

.arrow:hover {
  background: rgba(0, 0, 0, 0.8);
}

.category-nav {
  margin: 20px 0;
  padding: 10px;
  background-color: #f4f4f4;
  border-radius: 8px;
  overflow-x: auto;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}

.category-scroll {
  display: flex;
  gap: 12px;
  justify-content: center;
  padding-left: 10px;
}

.category-link {
  padding: 8px 16px;
  background-color: #388659;
  color: white;
  text-decoration: none;
  border-radius: 6px;
  font-weight: bold;
  transition: background-color 0.3s;
  flex-shrink: 0;
}

.category-link:hover {
  background-color: #2c6a4e;
}

.shopComponent {
  padding: 20px;
  margin: 10px;
  background: #f4f4f4;
  border-radius: 12px;
}

.shopGrid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  padding: 10px;
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



  button:hover {
    opacity: 0.9;
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  }

  @media (max-width: 768px) {
    .shopGrid {
      grid-template-columns: 1fr;
    }

    .slideshow {
      height: 300px;
    }
    .category-scroll {
    gap: 8px;
    justify-content: flex-start;
  }

  .category-link {
    font-size: 0.9rem;
    padding: 6px 12px;
  }
  }

  .infoGridItem {
    display: grid;
    grid-template-columns: 1fr;
    gap: 6px 12px;
    grid-template-areas:
    "a"
    "b"
    "c";
    align-items: center;
    margin-left: 10%;
    margin-right: 10%;
    color: black;
  }

  .desc {
    grid-area: a;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    max-height: 4.5em;
    height: 4.5em;
    text-align: center;
  }

  .price {
    grid-area: b;
    font-weight: bold;
    font-size: 16px;
    color: #388659;
    text-align: center;
  }

  .but {
    grid-area: c;
    background: #388659;
    color: white;
    border: none;
    padding: 10px 16px;
    margin-top: 10px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s ease;
    align-items: center;
  }

  .infoGridShop {
    display: grid;
    grid-template-columns: 1fr 3fr;
    gap: 6px 12px;
    grid-template-areas:
    "a b"
    "c d"
    "e e"
    "f f";
    align-items: center;
    margin-left: 10%;
    margin-right: 10%;
    color: black;
  }

  .lab1 {
    grid-area: a;
    font-weight: bold;
    text-align: left;
  }

  .lab2 {
    grid-area: c;
    font-weight: bold;
    text-align: left;
    max-height: 3em;
    height: 3em;
  }

  .inf1 {
    grid-area: b;
    text-align: left;
  }

  .inf2 {
    grid-area: d;
    text-align: left;
    max-height: 3em;
    height: 3em;
  }

  .descShop {
    grid-area: e;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    max-height: 4.5em;
    height: 4.5em;
  }

  .butShop {
    grid-area: f;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border: none;
    padding: 10px 16px;
    margin-top: 10px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s ease;
    align-items: center;
  }
  

@media (max-width: 768px) {
  .productImage, .slide {
    max-height: 200px;
  }

 .categoryCard {
    max-width: 100%;
  }
}

h4 {
  margin: 5px 0;
  font-size: 18px;
  font-weight: bold;
  color: black;
}

.title {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;
  max-height: 23px;
  height: 23px;
}
.carousel-wrapper {
  position: relative;
  overflow: hidden;
  padding: 10px 0;
}

.carousel {
  display: flex;
  gap: 1rem;
  overflow-x: auto;
  scroll-behavior: smooth;
  padding: 10px;
  -webkit-overflow-scrolling: touch;
}

.carousel::-webkit-scrollbar {
  height: 8px;
}

.carousel::-webkit-scrollbar-thumb {
  background-color: #ccc;
  border-radius: 4px;
}

.carousel::-webkit-scrollbar-track {
  background-color: #f4f4f4;
}

.carousel:hover::-webkit-scrollbar-thumb {
  background-color: #888;
}

.carousel-arrow {
  position: absolute;
  top: 51%;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding-top: 0.2rem;
  padding-bottom: 0.4rem;
  cursor: pointer;
  font-size: 1.5rem;
  border-radius: 50%;
  z-index: 2;
}

.carousel-arrow.left {
  right: 15px;
  padding-left: 0.3rem;
  padding-right: 0.5rem;
}

.carousel-arrow.right {
  right: 15px;
  padding-left: 0.5rem;
  padding-right: 0.3rem;
}

.carousel-arrow:hover {
  background: rgba(0, 0, 0, 0.8);
}

.shopCard {
  min-width: 250px;
  max-width: 250px;
  height: 450px;
  background: white;
  border-radius: 12px;
  padding: 15px;
  text-align: center;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  height: 100%; 
}

.shopCard:hover {
  transform: scale(1.025);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.button-bottom {
  display: flex;
  justify-content: center;
  margin-top: auto; 
}

.productImage {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 12px;
}

h4.title {
  font-size: 1.2rem;
  margin: 0.5rem 0;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.desc, .descShop {
  font-size: 0.9rem;
  color: #555;
  margin: 0.3rem 0;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.price {
  font-weight: bold;
  font-size: 1rem;
  color: #388659;
}

@media (max-width: 768px) {
  .carousel-arrow {
    font-size: 1.2rem;
  }

  .productImage {
    height: 150px;
  }

  

  .desc, .descShop {
    font-size: 0.8rem;
  }
}


</style>
