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

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f4f9f4;
  padding: 1rem 2rem;
  border-bottom: 2px solid #ccc;
  position: sticky;
  top: 0;
  z-index: 1000;
}

.logo {
  font-size: 1.6rem;
  font-weight: bold;
  color: #6b8e23;
  text-decoration: none;
  transition: color 0.3s;
}
.logo:hover {
  color: #556b2f;
}

.nav-links a {
  margin: 0 1rem;
  text-decoration: none;
  color: #333;
  font-weight: 500;
  transition: color 0.3s;
}
.nav-links a:hover,
.nav-links a.active {
  color: #6b8e23;
  font-weight: bold;
}

.search-bar {
  padding: 0.4rem 0.8rem;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 1rem;
  width: 200px;
}

.auth-button {
  margin-left: 1rem;
  color: #6b8e23;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s;
}
.auth-button:hover {
  color: #556b2f;
}

.user-dropdown {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  position: relative;
}
.profile-img {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 1px solid #ccc;
}
.dropdown-menu {
  position: absolute;
  top: 110%;
  right: 0;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 0.5rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  display: none;
  flex-direction: column;
  min-width: 120px;
}
.user-dropdown:hover .dropdown-menu {
  display: flex;
}
.dropdown-menu a {
  color: #333;
  text-decoration: none;
  padding: 0.4rem 0.6rem;
  transition: background-color 0.2s;
}
.dropdown-menu a:hover {
  background-color: #f0f0f0;
}


.mobile-toggle {
  display: none;
  font-size: 1.8rem;
  cursor: pointer;
}

.mobile-menu {
  display: none;
  flex-direction: column;
  background-color: #ffffff;
  padding: 1rem;
  border-top: 1px solid #ccc;
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  z-index: 999;
}
.mobile-menu a {
  padding: 0.5rem;
  text-decoration: none;
  color: #333;
  font-weight: 500;
}
.mobile-menu a:hover {
  background-color: #f4f4f4;
}
/*Responsiveness*/
@media (max-width: 768px) {
  .nav-links,
  .nav-center,
  .nav-right {
    display: none;
  }

  .mobile-toggle {
    display: block;
  }

  .mobile-menu {
    display: flex;
  }
}
</style>
