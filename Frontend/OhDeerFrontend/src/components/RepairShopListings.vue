<script setup>
import { ref, computed } from 'vue'
import testImage from '@/assets/test.png'
import slugify from 'slugify'
import navBar from './nav-bar.vue'

const repairshopItems = ref([
  {
    id: 1,
    title: 'Furniture Repair',
    link: 'FurnitureRepair',
    description: 'Fix broken furniture',
    address: 'Fifi Street 21',
    postalCode: '7649 Gabgob',
    phone: '043 748 384 213 64',
    image:
      'https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg',
  },
  {
    id: 2,
    title: 'Sofa Repair',
    link: 'SofaRepair',
    description: 'Fix broken sofas',
    address: 'huhu Street 2',
    postalCode: '2765 Sigma City',
    phone: '043 748 384 213 64',
    image:
      'https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg',
  },
  {
    id: 3,
    title: 'chingchenghanji',
    link: 'chingchenghanji',
    description:
      'Some text about the nverui78  43h79f h78 3478  78z 8 438ohgc348 fzew zewbvf euerhufheberuigjeans..qefrgvergregreger wefewewf ew rgiegier ierg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz',
    address: 'buien vreievniu veri 893',
    postalCode: '1003 Delta County',
    phone: '043 748 384 213 64',
    image: testImage,
  },
  {
    id: 4,
    title: 'chingchenghanji',
    link: 'chingchenghanji',
    description:
      'Some text about the nverui78  43h79f h78 3478  78z 8 438ohgc348 fzew zewbvf euerhufheberuigjeans..qefrgvergregreger wefewewf ew rgiegier ierg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz',
    address: 'buien vreievniu veri 893',
    postalCode: '1003 Delta County',
    phone: '043 748 384 213 64',
    image: testImage,
  },
  {
    id: 5,
    title: 'chingchenghanji',
    link: 'chingchenghanji',
    description:
      'Some text about the nverui78  43h79f h78 3478  78z 8 438ohgc348 fzew zewbvf euerhufheberuigjeans..qefrgvergregreger wefewewf ew rgiegier ierg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz',
    address: 'buien vreievniu veri 893',
    postalCode: '1003 Delta County',
    phone: '043 748 384 213 64',
    image: testImage,
  },
])

const images = ref([
  {
    src: 'https://cdn-images-1.medium.com/max/1600/1*bzScNScXnXNvjg-Ak70EHA.jpeg',
    url: 'https://example.com/1',
  },
  {
    src: 'https://dornob.com/wp-content/uploads/2009/04/plywood02_1000.jpg',
    url: 'https://example.com/2',
  },
  {
    src: 'https://www.gen-pack.com/wp-content/uploads/2021/04/Rework-_-Repair-Button-212287633-768x509.jpg',
    url: 'https://example.com/3',
  },
])
</script>
<template>
  <main>
    <navBar />
    <div class="container">
      <div class="shop">
        <div class="shopComponent">
          <h3>Repair Shops</h3>
          <div class="shopGrid">
            <div v-for="shop in repairshopItems" :key="shop.id" class="shopCard">
              <img :src="shop.image" alt="Product Image" class="productImage" />
              <h4>{{ shop.title }}</h4>
              <div class="infoGrid">
                <p class="lab1">Phone:</p>
                <p class="inf1">{{ shop.phone }}</p>
                <p class="lab2">Address:</p>
                <p class="inf2">{{ shop.address + ', ' + shop.postalCode }}</p>
                <p class="desc">{{ shop.description }}</p>
                <router-link
                  :to="`/inspectrepair/${slugify(shop.link)}-${shop.id}`"
                  custom
                  v-slot="{ navigate }"
                >
                  <button class="but" @click="navigate">more information</button>
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
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
  height: 220px;
  object-fit: contain;
  border-radius: 12px;
}

.price {
  font-weight: bold;
  font-size: 16px;
  color: #388659;
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
  margin: 2px 0;
}

.infoGrid {
  display: grid;
  grid-template-columns: 1fr 3fr;
  gap: 6px 12px;
  grid-template-areas:
    'a b'
    'c d'
    'e e'
    'f f';
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

.desc {
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

.but {
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

button:hover {
  opacity: 0.9;
  transform: scale(1.05);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}
</style>
