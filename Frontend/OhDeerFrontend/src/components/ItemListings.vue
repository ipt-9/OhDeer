<script setup>
import { ref, onMounted } from 'vue';
import slugify from 'slugify';
import navBar from './nav-bar.vue';

const shopItems = ref([]);
const errorMessage = ref('');
const nonRepairItems = ref([]);

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
      .map(item => ({
        id: item.id,
        is_repair: item.is_repair,
        title: item.title,
        link: slugify(item.title),
        description: item.description,
        price: item.price,
        image: item.image_1 || 'https://api.ohdeer-bmsd22a.bbzwinf.ch/OhDeerPlaceholder.png',
      }));

  nonRepairItems.value = shopItems.value.filter(item => !item.is_repair);

  } catch (err) {
    errorMessage.value = 'Error fetching items: ' + err.message;
    console.error(err);
  }
}

onMounted(() => {
  fetchItems();
});
</script>

<template>
  <main>
    <navBar />
    <div class="container">
      <div class="shop">
        <div class="shopComponent">
          <h3>Items</h3>
          <div class="shopGrid">
            <div v-for="item in nonRepairItems" :key="item.id" class="shopCard">
              <img :src="item.image" alt="Product Image" class="productImage" />
              <h4 class="title">{{ item.title }}</h4>
              <div class="infoGrid">
                <p class="desc">{{ item.description }}</p>
                <p class="price">${{ item.price }}</p>
                <router-link
                  :to="`/inspectitem/${slugify(item.link)}-${item.id}`"
                  custom
                  v-slot="{ navigate }"
                >
                  <button class="but" @click="navigate">Buy Now</button>
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
.container {
  margin: auto;
  padding: 20px;
  font-family: 'Poppins', sans-serif;
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
  transition:
    transform 0.3s,
    box-shadow 0.3s;
}

.shopCard:hover {
  transform: scale(1.025);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.productImage {
  width: 100%;
  height: auto;
  max-height: 300px;
  object-fit: contain;
  border-radius: 12px;
}


@media (max-width: 768px) {
  .shopGrid {
    grid-template-columns: 1fr;
  }

  .slideshow {
    height: 300px;
  }
}

h3 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 15px;
  color: black;
}

h4 {
  margin: 5px 0;
  font-size: 18px;
  font-weight: bold;
  color: black;
}

p {
  font-size: 14px;
  color: black;
  margin: 5px 0;
}

.infoGrid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 6px 12px;
  grid-template-areas:
    'a'
    'b'
    'c';
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

button:hover {
  opacity: 0.9;
  transform: scale(1.05);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
</style>
