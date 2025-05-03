<template>
    <div id="app">
      <!-- Optional: Your global layout (like a navbar or sidebar) -->
      <!-- <header>
        <nav>
          <ul>
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/login">Login</router-link></li>
          </ul>
        </nav>
      </header> -->
  
      <!-- The main content rendered by Vue Router -->
      <router-view></router-view>
  
      <!-- Optional: Footer -->
      <!-- <footer style="position: fixed; bottom: 0px; width: 100vw;">
        <p>© 2025 | M.Helal</p>
      </footer> -->
    </div>
  </template>
  
  <script setup>
  // You can import global components, use refs, and define your logic here
  </script>
  
  <style scoped>
  /* Your component-specific styles can go here */
  #app {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    /* padding: 20px; */
  }
  
  header {
    background-color: #007bff;
    padding: 10px;
  }
  
  footer {
    /* text-align: center; */
    padding: 10px;
    background-color: #333;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  nav ul {
    list-style: none;
    padding: 0;
  }
  
  nav li {
    display: inline-block;
    margin-right: 10px;
  }
  
  nav a {
    color: white;
    text-decoration: none;
  }
  </style>
  