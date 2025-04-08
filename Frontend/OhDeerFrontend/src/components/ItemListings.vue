<script setup>
import { ref, computed } from "vue";
import testImage from '../assets/test.png';

const shopItems = ref([
  { id: 1, title: "Wooden Table", description: "Handcrafted table", price: 120, is_repair: 0, image: "https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg" },
  { id: 2, title: "Vintage Chair", description: "Classic chair", price: 80, is_repair: 0, image: "https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg" },
  { id: 3, title: "Furniture Repair", description: "Fix broken furniture", price: 50, is_repair: 1, image: "https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg" },
  { id: 4, title: "Sofa Repair", description: "Fix broken sofas", price: 100, is_repair: 1, image: "https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg" },
  { id: 5, title: "chingchenghanji", description: "Some text about the nverui78  43h79f h78 3478  78z 8 438ohgc348 fzew zewbvf euerhufheberuigjeans..qefrgvergregreger wefewewf ew rgiegier ierg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz", price: 500, is_repair: 0, image: "../assets/test.png" },
]);

const nonRepairItems = computed(() => shopItems.value.filter(item => item.is_repair === 0));
const repairItems = computed(() => shopItems.value.filter(item => item.is_repair === 1));

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
<template>
    <main>
        <div class="container">
        <div class="shop">
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
        </div>
    </div>
    </main> 
</template>
<style scoped>
    .container {
    max-width: 1200px;
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
    background: #fff;
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

    .cardContent p {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    max-height: 4.5em;
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

    h3 {
    text-align: center;
    font-size: 22px;
    margin-bottom: 15px;
    color: #333;
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
/*
    img {
        max-width: 300px;
        max-height: 300px;
        height: fit-content;
    }

    .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
    max-height: 500px;
    height: fit-content;
    margin: 20px;
    text-align: center;
    }
    
    .cardTe {
        color: black;
        max-height: 74px;
        max-width: 400px;
        padding-left: 20px;
        padding-right: 20px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3; 
        -webkit-box-orient: vertical;
        word-break: break-word;
    }

    .cardTi {
        color: black;
        text-align: center;
    }

    .price {
    color: black;
    font-size: 22px;
    }

    .card button {
    border: none;
    outline: 0;
    padding: 10px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 14px;
    }

    .card button:hover {
    opacity: 0.7;
    }
    */
</style>