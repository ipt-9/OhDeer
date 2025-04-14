<template>
  <nav class="navbar">
  <div class="nav-left">
    <a href="/" class="logo">OhDeer</a>
    <div class="nav-links">
      <a href="/" class="active">Home</a>
      <a href="/shop">Shop</a>
      <a href="/repairs">Repair Shops</a>
    </div>
  </div>

  <div class="nav-center">
    <input type="text" placeholder="Search..." class="search-bar" />
  </div>

  <div class="nav-right">

    <div class="auth-buttons">
      <a href="/login" class="auth-button">Login</a>
      <a href="/register" class="auth-button">Register</a>
    </div>


    <div class="user-dropdown">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaVNmjsv3kTlDf_0RS0xRjuR4QSqJfrppOUQ&s" class="profile-img" alt="Profile" />
      <span>DeerUser</span>
      <div class="dropdown-menu">
        <a href="/settings">Settings</a>
        <a href="#" onclick="logout()">Logout</a>
      </div>
    </div>
  </div>


  <div class="mobile-toggle" onclick="toggleMobileMenu()">☰</div>


  <div class="mobile-menu">
    <a href="/">Home</a>
    <a href="/shop">Shop</a>
    <a href="/repairs">Repair Shops</a>
    <a href="/settings">Settings</a>
    <a href="/login">Login</a>
    <a href="/register">Register</a>
    <a href="#" onclick="logout()">Logout</a>
  </div>
</nav>

</template>
