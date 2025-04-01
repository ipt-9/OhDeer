<template>
    <div class="container">
        <!--These cards are basically 1 to 1 copies of W3 schools version, at least so far.
         We will probably change them a bit later, so their not 1 to 1 copies -->
        <div class="card">
        <img src="../assets/test.png" alt="song">
        <h1 class="cardTi">Tailored Jeans</h1>
        <p class="price">$19.99 </p>
        <p class="cardTe">Some text about the jeans..qefrgvergregreger wefewewf ew rgiegier ieuewuif hei hur  huirhuihrui   hh huih ruih rhui erhi hui erier iiuh uit hui hiurthui ut ui rti ui t t ui hrtuih uitr hui jj iu ui i uhiuuihhuivf h uhthuirhguigh uitrh  rth uih  huihtr uihbrui buin uitnbui  uib uirurb b uirb htrui buirbui rtirg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz</p>
        <p><button>Add to Cart</button></p>
        </div>
        <div class="card">
        <img src="../assets/test.png" alt="song">
        <h1 class="cardTi">Tailored Jeans</h1>
        <p class="price">$19.99 </p>
        <p class="cardTe">Some text about the jeans..qefrgvergregreger wefewewf ew rgiegier ierg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz</p>
        <p><button>Add to Cart</button></p>
        </div>
        <div class="card">
        <img src="../assets/test.png" alt="song">
        <h1 class="cardTi">Tailored Jeans</h1>
        <p class="price">$19.99 </p>
        <p class="cardTe">Some text about the jeans..qefrgvergregreger wefewewf ew rgiegier ierg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz</p>
        <p><button>Add to Cart</button></p>
        </div>
        <div class="card">
        <img src="../assets/test.png" alt="song">
        <h1 class="cardTi">Tailored Jeans</h1>
        <p class="price">$19.99 </p>
        <p class="cardTe">Some text about the jeans..qefrgvergregreger wefewewf ew rgiegier ierg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz</p>
        <p><button>Add to Cart</button></p>
        </div>
        <div class="card">
        <img src="../assets/test.png" alt="song">
        <h1 class="cardTi">Tailored Jeans</h1>
        <p class="price">$19.99 </p>
        <p class="cardTe">Some text about the jeans..qefrgvergregreger wefewewf ew rgiegier ierg hi hhhhhh pppppp 2222 w r e q 7gregh9ehgehugherhge reui jihnuu ewz</p>
        <p><button>Add to Cart</button></p>
        </div>
    </div>
    
</template>
<style>
    body {background-color: #e6e8e6}

    img {
        max-width: 300px;
        max-height: 300px;
        height: fit-content;
    }

    .container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px ;
    }

    /* These cards are basically 1 to 1 copies of W3 schools version, at least so far.
         We will probably change them a bit later, so their not 1 to 1 copies, looks wise,
          but most of this also has new features and design additions.*/
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
</style>