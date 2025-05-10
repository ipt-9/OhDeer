<script setup>
import { useRoute } from 'vue-router';
import { RouterLink } from "vue-router";
import slugify from "slugify";
import navBar from './nav-bar.vue';

const route = useRoute();
const { title, id } = route.params

</script>

<template>
    <main>
        <navBar />
        <div class="container">
            <div class="item">
                <div class="grid">
                    <div class="card">
                        <img class="image" src="https://www.ikea.com/ch/en/images/products/nordviken-chair-antique-stain__0832454_pe777681_s5.jpg">                       
                    </div>
                    <div class="card">
                        <div class="infoGrid">
                            <div class="title">
                                <h1>{{ title }}</h1>
                            </div>
                            <div class="info">
                                <h4 class="lab1">description:</h4>
                                <p class="desc">huewhu  ezig ehg uirhhu uhih uihrh ui uih uirhui iu iug g ff  ztf tzf tzfft tz ftz ztftf zu tzf zjfz ztt ftz fztu tzt tz ftzztfftjfhj ftzftz f e gzufvgzu guf gwz  v  g erg reg r 4geg fr</p>
                                
                                <h4 class="lab2">delivery:</h4>
                                <p class="deliv">uebuwfwgbfuzrfberui</p>
                                
                                <h4 class="lab3">phone:</h4> 
                                <p class="inf1">041 273 718 23 76</p>    
                                
                                <h4 class="lab4">email:</h4>
                                <p class="inf2">12345678901234567890123456789012345@12345678901234567890123456789012345@12345678901234567890123456789012345@</p>
                            </div>
                            <div class="space"></div>
                            <div class="footer">
                                <h4 class="price">850 CHF</h4>
                                <router-link :to="`/InspectItem`" custom v-slot="{navigate}"> <!-- /${slugify(item.link)}-${item.id} -->
                                    <button class="but" @click="navigate">Purchase</button>
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
    max-width: 1400px;
    margin: auto;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
    }

    .item {
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding: 20px;
    }

    .grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 20px;
    padding: 10px;
    }

    .image {
        grid-area: a;
        width: 100%;
        height: 600px;
        object-fit: contain;
        border-radius: 12px;
    }

    @media (max-width: 768px) {
    .Grid {
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
    font-size: 15px;
    font-weight: bold;
    color: black;
    }

    p {
    font-size: 14px;
    color: black;
    margin: 5px 0;
    }

    .card {
    background: white;
    border-radius: 12px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    }

    .infoGrid {
    display: flex;
    flex-direction: column;
    height: 100%;
    margin-left: 10%;
    margin-right: 10%;
    color: black;
    }

    .title {
        text-align: center;
        margin-bottom: 16px;
    }

    .info { 
    display: grid;
    grid-template-columns: 1fr 4fr;
    gap: 6px 12px;
    }

    .spacer {
    flex-grow: 1;
    }

    .footer {
        margin-top: auto;
        text-align: center;
    }

    .lab1 {
        font-weight: bold;
        text-align: left;
    }

    .lab2 {
        font-weight: bold;
        text-align: left;
    }

    .lab3 {
        font-weight: bold;
        text-align: left;
    }

    .lab4 {
        font-weight: bold;
        text-align: left;
    }

    .inf1 {
        overflow-wrap: break-word;
        word-break: break-all;     
        white-space: normal;   
        text-align: left;
    }

    .inf2 {
        overflow-wrap: break-word;
        word-break: break-all;     
        white-space: normal;   
        text-align: left;
    }

    .deliv {
        overflow-wrap: break-word;
        word-break: break-all;     
        white-space: normal;   
        text-align: left;
    }

    .desc {
        overflow-wrap: break-word;
        word-break: break-all;     
        white-space: normal;   
        text-align: left;
    }

    .price {
        font-weight: bold;
        font-size: 16px;
        color: #388659;
        text-align: center;
    }

    .but {
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

</style>