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
                                
                                <h4 class="lab2">Link:</h4>
                                <p class="inf1">https://www.google.com/maps</p>
                                
                                <h4 class="lab3">Address:</h4>
                                <p class="inf2">uebuwfwgbfuzrfberui</p>
                                
                                <h4 class="lab4">Postal Code:</h4> 
                                <p class="inf3">16383461384728438</p>    
                                
                                <h4 class="lab5">email:</h4>
                                <p class="inf4">12345678901234567890123456789012345@12345678901234567890123456789012345@12345678901234567890123456789012345@</p>
                                
                                <h4 class="lab6">Phone:</h4>
                                <p class="inf5">532784327r46343784283428</p>
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

    .lab5 {
        font-weight: bold;
        text-align: left;
    }

    .lab6 {
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

    .inf3 {
        overflow-wrap: break-word;
        word-break: break-all;     
        white-space: normal;   
        text-align: left;
    }

    .inf4 {
        overflow-wrap: break-word;
        word-break: break-all;     
        white-space: normal;   
        text-align: left;
    }

    .inf5 {
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
</style>