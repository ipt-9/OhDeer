<template>
<div class="container">
    <div class="head">
      <div class="slideshow">
        <a :href="images[currentIndex].url" target="_blank">
          <img :src="images[currentIndex].src" class="slide" alt="Slideshow Image" />
        </a>
        <button class="arrow left" @click="prevSlide">&#9664;</button>
        <button class="arrow right" @click="nextSlide">&#9654;</button>
      </div>
    </div>
    <div class="main">
      <div class="introText"></div>
      <div class="shop">
        <div class="shopCategoriesComponent">

        </div>
        <div class="shopComponent">
      <h3>Items Near You</h3>
      <div class="shopGrid">
        <div v-for="item in nonRepairItems" :key="item.id" class="shopCard">
          <img :src="item.image" alt="Product Image" class="productImage" />
          <div class="cardContent">
            <h4>{{ item.title }}</h4>
            <p>{{ item.description }}</p>
            <p class="price">${{ item.price }}</p>
            <button class="buyButton">Buy Now</button>
          </div>
        </div>
      </div>
    </div>

    <div class="shopComponent">
      <h3>Repair Shops Near You</h3>
      <div class="shopGrid">
        <div v-for="item in repairItems" :key="item.id" class="shopCard">
          <img :src="item.image" alt="Repair Image" class="productImage" />
          <div class="cardContent">
            <h4>{{ item.title }}</h4>
            <p>{{ item.description }}</p>
            <p class="price">${{ item.price }}</p>
            <button class="repairButton">Get Repair</button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
</template>

<script setup>
import { ref } from "vue";

const shopItems = ref([
  { id: 1, title: "Wooden Table", description: "A handcrafted wooden table", price: 120, is_repair: 0 , image: "https://www.ikea.com/ch/en/images/products/ekedalen-extendable-table-oak__0736964_pe740828_s5.jpg?f=s"},
  { id: 2, title: "Vintage Chair", description: "A classic wooden chair", price: 80, is_repair: 0 , image: "https://www.ikea.com/ch/en/images/products/ekedalen-extendable-table-oak__0736964_pe740828_s5.jpg?f=s"},
  { id: 3, title: "Furniture Repair", description: "We repair your furniture", price: 50, is_repair: 1 , image: "https://www.ikea.com/ch/en/images/products/ekedalen-extendable-table-oak__0736964_pe740828_s5.jpg?f=s"},
  { id: 4, title: "Sofa Repair", description: "Fixing broken sofas", price: 100, is_repair: 1 , image: "https://www.ikea.com/ch/en/images/products/ekedalen-extendable-table-oak__0736964_pe740828_s5.jpg?f=s"},
]);


const nonRepairItems = computed(() => shopItems.value.filter(item => item.is_repair === 0));
const repairItems = computed(() => shopItems.value.filter(item => item.is_repair === 1));


const images = ref([
  { src: "https://cdn-images-1.medium.com/max/1600/1*bzScNScXnXNvjg-Ak70EHA.jpeg", url: "https://example.com/1" },
  { src: "https://dornob.com/wp-content/uploads/2009/04/plywood02_1000.jpg", url: "https://example.com/2" },
  { src: "https://www.gen-pack.com/wp-content/uploads/2021/04/Rework-_-Repair-Button-212287633-768x509.jpg", url: "https://example.com/3" },
]);

const currentIndex = ref(0);

const prevSlide = () => {
  currentIndex.value = (currentIndex.value - 1 + images.value.length) % images.value.length;
};

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % images.value.length;
};
</script>

<style scoped>.container {
  max-width: 1200px;
  margin: auto;
  padding: 20px;
  font-family: 'Poppins', sans-serif;
}

.head {
  text-align: center;
  margin-bottom: 20px;
}

.slideshow {
  position: relative;
  width: 100%;
  max-width: 900px;
  height: 400px;
  margin: auto;
  overflow: hidden;
  border-radius: 15px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.slide {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 15px;
}

.arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px 15px;
  cursor: pointer;
  font-size: 20px;
  transition: background 0.3s;
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

/* SHOP SECTION */
.shop {
  display: flex;
  flex-direction: column;
  gap: 30px;
  padding: 20px;
}

.shopComponent {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h3 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 15px;
  color: #333;
}

.shopGrid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  padding: 10px;
}

.shopCard {
  background: white;
  border-radius: 12px;
  padding: 15px;
  text-align: center;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
}

.shopCard:hover {
  transform: scale(1.05);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.productImage {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 12px;
}

.cardContent {
  padding: 15px 0;
}

h4 {
  margin: 5px 0;
  font-size: 18px;
  font-weight: bold;
}

p {
  font-size: 14px;
  color: #666;
  margin: 5px 0;
}

.price {
  font-weight: bold;
  font-size: 16px;
  color: #ff5722;
}

.buyButton, .repairButton {
  background: linear-gradient(135deg, #ff6f61, #ff3d00);
  color: white;
  border: none;
  padding: 10px 16px;
  margin-top: 10px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  transition: 0.3s ease;
}

.repairButton {
  background: linear-gradient(135deg, #007bff, #0056b3);
}

.buyButton:hover, .repairButton:hover {
  opacity: 0.9;
}

@media (max-width: 768px) {
  .shopGrid {
    grid-template-columns: 1fr;
  }

  .slideshow {
    height: 300px;
  }
}

</style>
