  <template>
    <div class="container">
      <div class="head">
        <navBar />
        <div class="slideshow">
          <a :href="images[currentIndex].url" target="_blank">
            <img :src="images[currentIndex].src" class="slide" alt="Slideshow Image" />
          </a>
          <button class="arrow left" @click="prevSlide">&#9664;</button>
          <button class="arrow right" @click="nextSlide">&#9654;</button>
        </div>
      </div>

      <div class="filterButtons">
        <button :class="{ active: slideFilter === 'all' }" @click="slideFilter = 'all'">All</button>
        <button :class="{ active: slideFilter === 'items' }" @click="slideFilter = 'items'">Only Items</button>
        <button :class="{ active: slideFilter === 'repairs' }" @click="slideFilter = 'repairs'">Only Repair Shops</button>
      </div>
      
      <div class="main">
        <div class="shop">
          <div class="shopCategoriesComponent">
            <h3>Categories</h3>
            <div class="categoryGrid">
              <router-link
                v-for="category in categories"
                :key="category.id"
                :to="`/category/${category.slug}`"
                class="categoryCard"
                :style="{ backgroundImage: `url(${category.image})` }"
              >
                <h3>{{ category.name }}</h3>
              </router-link>
            </div>
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

          <div class="shopGrid">
            <div v-for="item in items" :key="item.id" class="shopCard">
              <img :src="item.image" alt="Product Image" class="productImage" />
              <div class="cardContent">
                <h4>{{ item.title }}</h4>
                <p>{{ item.description }}</p>
                <p class="price">${{ item.price }}</p>
                <button class="buyButton">Buy Now</button>
              </div>
            </div>
          </div>

          <div class="shopComponent">
            <h3>Repair Shops Near You</h3>
            <div class="shopGrid">
              <div v-for="item in repairItems" :key="item.id" class="shopCard">
                <div class="cardImage">
                  <img :src="item.image" alt="Repair Image" class="productImage" />
                </div>
                <div class="cardContent">
                  <h4>{{ item.title }}</h4>
                  <p>{{ item.description }}</p>
                  <p class="price">${{ item.price }}</p>
                  <button class="repairButton">Get Repair</button>
                </div>
              </div>
            </div>
          </div>

          <div class="shopComponent">
            <h3>New Arrivals</h3>
            <div class="shopGrid">
              <div v-for="item in newArrivals" :key="item.id" class="shopCard">
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
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import navBar from "./nav-bar.vue";
  import { ref } from "vue";
  import { computed } from "vue";

  const shopItems = ref([
    { id: 1, title: "Wooden Table", description: "Handcrafted table", price: 120, is_repair: 0, image: "https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg" },
    { id: 2, title: "Vintage Chair", description: "Classic chair", price: 80, is_repair: 0, image: "https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg" },
    { id: 3, title: "Furniture Repair", description: "Fix broken furniture", price: 50, is_repair: 1, image: "https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg" },
    { id: 4, title: "Sofa Repair", description: "Fix broken sofas", price: 100, is_repair: 1, image: "https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg" },
  ]);
  const categories = ref([
    { id: 1, name: "Furniture & Home Items", slug: "furniture-home", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" },
    { id: 2, name: "Electronics", slug: "electronics", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" },
    { id: 3, name: "Household Appliances", slug: "household-appliances", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" },
    { id: 4, name: "Clothing & Accessories", slug: "clothing-accessories", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" },
    { id: 5, name: "Vehicles & Mobility", slug: "vehicles-mobility", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" },
    { id: 6, name: "Luxury & Accessories", slug: "luxury-accessories", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" },
    { id: 7, name: "Toys & Hobby Items", slug: "toys-hobby", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" },
    { id: 8, name: "More Categories", slug: "more-categories", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" }
  ]);

  const nonRepairItems = computed(() => shopItems.value.filter(item => item.is_repair === 0));
  const repairItems = computed(() => shopItems.value.filter(item => item.is_repair === 1));
  const newArrivals = computed(() => shopItems.value.slice(-2));

  const images = ref([
    { src: "https://cdn-images-1.medium.com/max/1600/1*bzScNScXnXNvjg-Ak70EHA.jpeg", url: "https://example.com/1" },
    { src: "https://dornob.com/wp-content/uploads/2009/04/plywood02_1000.jpg", url: "https://example.com/2" },
    { src: "https://www.gen-pack.com/wp-content/uploads/2021/04/Rework-_-Repair-Button-212287633-768x509.jpg", url: "https://example.com/3" },
  ]);

  const slideFilter = ref("all");

  const filteredSlides = computed(() => {
    if (slideFilter.value === "items") return images.value.filter(img => img.type === "item");
    if (slideFilter.value === "repairs") return images.value.filter(img => img.type === "repair");
    return images.value;
  });

  const currentIndex = ref(0);
  const prevSlide = () => currentIndex.value = (currentIndex.value - 1 + filteredSlides.value.length) % filteredSlides.value.length;
  const nextSlide = () => currentIndex.value = (currentIndex.value + 1) % filteredSlides.value.length;

  </script>

  <style scoped>
  .container {
    margin: 0px;
    padding: 0px;
    font-family: 'Poppins', sans-serif;
  }

  .categoryGrid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    padding-top: 10px;
  }

  .categoryCard {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background-size: cover;
    background-position: center;
    color: white;
    font-weight: bold;
    text-decoration: none;
    height: 150px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
  }

  .categoryCard:hover {
    transform: scale(1.05);
    opacity: 0.9;
  }

  .head {
    text-align: center;
    margin-bottom: 20px;
  }

  .slideshow {
    position: relative;
    display: block;
    min-width: 100%;
    background-position: center;
    height: 65vh;
    max-height: 70%;
    margin: auto;
    overflow: hidden;
    border-radius: 0px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    object-fit: cover;
    object-position: center;
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

  .shop {
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding: 20px;
  }

  .shopComponent {
    background: #f3f4f3;
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
    color: #388659;
  }

  .buyButton, .repairButton {
    background: #388659;
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
