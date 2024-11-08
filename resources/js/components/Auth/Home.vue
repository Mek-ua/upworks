<template>
  <div style="background-image: url('/images/hero/bg3.jpg');" class="relative w-full h-screen bg-cover bg-center">
    <!-- Darker Overlay with Blur -->
    <div class="absolute inset-0 bg-black opacity-60 backdrop-blur-sm"></div>

    <!-- Navbar with Logo, Links, and Auth Options -->
    <nav class="fixed top-0 z-50 w-full flex items-center justify-between px-8 py-4 bg-transparent">

    
        <div class="flex items-center justify-center ">
          <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-500 text-white">
            <span class="text-lg font-bold m">F</span>
          </div>
          <h2 class="ml-2 text-2xl font-bold text-white">Freelance-Hub</h2>
        </div>
      
      <div class="flex space-x-6 ml-auto">
        <router-link to="/" class="text-white hover:text-blue-400">Home</router-link>
        <router-link to="/About" class="text-white hover:text-blue-400">About us</router-link>
        <router-link to="/contact" class="text-white hover:text-blue-400">Contact Us</router-link>
      </div>
      <div class="flex space-x-4 ml-6">
        <router-link to="/login" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">Login</router-link>
        <router-link to="/role-selection" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">Sign Up</router-link>

      </div>
    </nav>

    <!-- Content over the dimmed background -->
<!-- Content over the dimmed background -->
<header class="relative flex items-center text-white py-20 z-10 pl-8 pt-48 lg:pl-20 lg:w-1/2">
  <div>
    <h1 class="text-4xl font-bold mb-4 leading-tight">Find a new job and build your career</h1>
    <p class="text-lg text-white/80 mb-8">Find Jobs, Employment & Career Opportunities. Some of the companies we've helped recruit excellent applicants over the years.</p>

    <!-- Search Bar -->
    <div class="flex items-center bg-white rounded-full shadow-md overflow-hidden w-full max-w-lg mb-6">
      <input type="text" placeholder="Search your keywords" class="w-full py-3 px-4 text-gray-700 focus:outline-none" />
      <i data-feather="search" class="fea icon-20 icons"></i>
      <button class="bg-blue-500 text-white px-6 p-3 m-1 font-semibold hover:bg-blue-600 rounded-lg">Search</button>
    </div>
    <p class="text-white/70">
      <span class="text-white">Popular Searches:</span> Designer, Developer, Web, IOS, PHP Senior Engineer
    </p>
  </div>
</header>
    <!-- Stats Section -->
    <section class="text-center m-12 p-48">
      <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-around items-center">
          <div class="mb-8 md:mb-0">
            <h3 class="text-6xl font-semibold text-gray-800">1548K+</h3>
            <p class="text-gray-600 mt-2">JOB FULFILLMENT</p>
          </div>
          <div class="mb-8 md:mb-0">
            <h3 class="text-6xl font-semibold text-gray-800">25+</h3>
            <p class="text-gray-600 mt-2">BRANCHES</p>
          </div>
          <div>
            <h3 class="text-6xl font-semibold text-gray-800">9+</h3>
            <p class="text-gray-600 mt-2">YEARS EXPERIENCE</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Popular Job Listing Section -->
    <section class="-m-48 bg-gray-100">
      <div class="container mx-auto">
        <h1 class="text-4xl text-gray-900 text-center">Popular Job Listing</h1>
        <p class="text-center text-gray-400 mt-2 mb-8">
          Search all the open positions on the web. Get your own personalized salary estimate. <br>Read reviews on over 30000+ companies worldwide.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="job in popularJobs" :key="job.id" class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
            <h3 class="text-lg font-semibold text-gray-800">{{ job.title }}</h3>
            <p class="text-gray-500 mt-2">Posted {{ job.posted }}</p>
            <p class="text-gray-500">Salary: {{ job.salary }}</p>
            <p class="text-gray-500">Experience: {{ job.experience }}</p>
            <p class="text-gray-500 mt-2">{{ job.company }}</p>
            <p class="text-gray-500">{{ job.location }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Section -->
    <section class="flex flex-col lg:flex-row items-center justify-center py-60 bg-white">
      <div class="lg:w-1/2 flex justify-center">
        <!-- Placeholder image -->
      </div>
      <div class="lg:w-1/2 mt-8 lg:mt-0 lg:ml-12 text-center lg:text-left">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Millions of jobs. Find the one that's right for you.</h2>
        <p class="text-gray-600 mb-6">Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 30000+ companies worldwide.</p>
        <ul class="text-gray-700 mb-6 space-y-2">
          <li><span class="text-blue-500 mr-2">✔️</span>Digital Marketing Solutions for Tomorrow</li>
          <li><span class="text-blue-500 mr-2">✔️</span>Our Talented & Experienced Marketing Agency</li>
          <li><span class="text-blue-500 mr-2">✔️</span>Create your own skin to match your brand</li>
        </ul>
        <button class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600">ABOUT US</button>
      </div>
    </section>

    <!-- Browse by Categories Section -->
    <section class="-m-2 py-3 bg-slate-100">
      <div class="container mx-auto">
        <h2 class="text-4xl font-semibold text-center text-gray-800 mb-8">Browse by Categories</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
          <div v-for="category in categories" :key="category.name" class="bg-gray-50 p-6 rounded-lg text-center shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800">{{ category.name }}</h3>
            <p class="text-gray-500">{{ category.jobs }} Jobs Available</p>
            <a href="#" class="text-blue-500 mt-4 inline-block">Explore Jobs</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Latest Blog or News Section -->
    <section class="py-16 -m-4 bg-gray-200">
      <div class="container mx-auto">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-4">Latest Blog or News</h2>
        <p class="text-center text-gray-600 mb-12">Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 30000+ companies worldwide.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- <img src="/images/blog1.jpg" alt="Blog Image" class="w-full h-48 object-cover"> -->
            <div class="p-6">
              <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold rounded-full px-2 py-1 mb-2">Arts</span>
              <p class="text-sm text-gray-500">31st October 2023 · 5 min read</p>
              <h3 class="text-lg font-semibold text-gray-800 mt-2">11 Tips to Help You Get New Clients Through Cold Calling</h3>
              <p class="text-blue-500 mt-4">Read Now →</p>
              <p class="text-sm text-gray-400 mt-1">By Google</p>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- <img src="/images/blog2.jpg" alt="Blog Image" class="w-full h-48 object-cover"> -->
            <div class="p-6">
              <span class="inline-block bg-purple-100 text-purple-800 text-xs font-semibold rounded-full px-2 py-1 mb-2">Illustration</span>
              <p class="text-sm text-gray-500">31st October 2023 · 5 min read</p>
              <h3 class="text-lg font-semibold text-gray-800 mt-2">DigitalOcean launches first Canadian data centre in Toronto</h3>
              <p class="text-blue-500 mt-4">Read Now →</p>
              <p class="text-sm text-gray-400 mt-1">By Facebook</p>
            </div>
            
          </div>

          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- <img src="/images/blog3.jpg" alt="Blog Image" class="w-full h-48 object-cover"> -->
            <div class="p-6">
              <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold rounded-full px-2 py-1 mb-2">Music</span>
              <p class="text-sm text-gray-500">31st October 2023 · 5 min read</p>
              <h3 class="text-lg font-semibold text-gray-800 mt-2">Using Banner Stands To Increase Trade Show Traffic</h3>
              <p class="text-blue-500 mt-4">Read Now →</p>
              <p class="text-sm text-gray-400 mt-1">By Linkedin</p>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- <img src="/images/blog3.jpg" alt="Blog Image" class="w-full h-48 object-cover"> -->
            <div class="p-6">
              <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold rounded-full px-2 py-1 mb-2">Music</span>
              <p class="text-sm text-gray-500">31st October 2023 · 5 min read</p>
              <h3 class="text-lg font-semibold text-gray-800 mt-2">Using Banner Stands To Increase Trade Show Traffic</h3>
              <p class="text-blue-500 mt-4">Read Now →</p>
              <p class="text-sm text-gray-400 mt-1">By Linkedin</p>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- <img src="/images/blog3.jpg" alt="Blog Image" class="w-full h-48 object-cover"> -->
            <div class="p-6">
              <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold rounded-full px-2 py-1 mb-2">Music</span>
              <p class="text-sm text-gray-500">31st October 2023 · 5 min read</p>
              <h3 class="text-lg font-semibold text-gray-800 mt-2">Using Banner Stands To Increase Trade Show Traffic</h3>
              <p class="text-blue-500 mt-4">Read Now →</p>
              <p class="text-sm text-gray-400 mt-1">By Linkedin</p>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- <img src="/images/blog3.jpg" alt="Blog Image" class="w-full h-48 object-cover"> -->
            <div class="p-6">
              <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold rounded-full px-2 py-1 mb-2">Music</span>
              <p class="text-sm text-gray-500">31st October 2023 · 5 min read</p>
              <h3 class="text-lg font-semibold text-gray-800 mt-2">Using Banner Stands To Increase Trade Show Traffic</h3>
              <p class="text-blue-500 mt-4">Read Now →</p>
              <p class="text-sm text-gray-400 mt-1">By Linkedin</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  <!-- Footer -->
<footer class="bg-gray-900 text-white py-16">
  <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between text-center lg:text-left">
    <div class="mb-4 lg:mb-0 flex items-center justify-center lg:justify-start">
      <span class="text-slate-300 font-bold  text-3xl">Freelance-Hub</span>
    </div>
    <div class="flex space-x-6 justify-center lg:justify-start mb-4 lg:mb-0">
      <a href="#" class="text-gray-200 hover:text-gray-400">Home</a>
      <a href="#" class="gray-200 hover:text-gray-400">How it works</a>
      <a href="#" class="gray-200 hover:text-gray-400">Create a Job</a>
      <a href="#" class="gray-200 hover:text-gray-400">About us</a>
      <!-- <a href="#" class="text-white hover:text-gray-400">Plans</a> -->
    </div>
    <div class="flex space-x-4 justify-center lg:justify-start">
      <a href="#" class="text-white hover:text-gray-400"><i class="fas fa-shopping-cart"></i></a>
      <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-dribbble"></i></a>
      <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-linkedin"></i></a>
      <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-facebook"></i></a>
      <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-instagram"></i></a>
      <!-- <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-twitter"></i></a> -->
    </div>
  </div>
  <div class="container mx-auto text-center mt-4">
    <p class="text-gray-500">© 2024 FREELANCE-HUB. Design with ❤️ by Mekides.</p>
  </div>
</footer>

  </div>
  
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
  name: 'Home',
  setup() {
    const popularJobs = ref([
      { id: 1, title: 'Web Designer / Developer', posted: '3 Days ago', salary: '$950 - $1100/mo', experience: 'Full Time', company: 'Facebook', location: 'Australia' },
      { id: 2, title: 'Marketing Director', posted: '3 Days ago', salary: '$950 - $1100/mo', experience: 'Part Time', company: 'Google', location: 'Australia' },
      { id: 3, title: 'Application Developer', posted: '3 Days ago', salary: '$950 - $1100/mo', experience: 'Remote', company: 'Android', location: 'Australia' },
      { id: 4, title: 'Senior Product Designer', posted: '3 Days ago', salary: '$950 - $1100/mo', experience: 'Full Time', company: 'Microsoft', location: 'USA' },
      { id: 5, title: 'C++ Developer', posted: '3 Days ago', salary: '$900 - $1000/mo', experience: 'Full Time', company: 'Apple', location: 'Canada' },
      { id: 6, title: 'PHP Developer', posted: '3 Days ago', salary: '$850 - $1000/mo', experience: 'Remote', company: 'Amazon', location: 'UK' }
    ]);

    const categories = ref([
      { name: "IT & Networkingt", jobs: 74 },
      { name: "Marketing & Communication", jobs: 20 },
      { name: "Project Management", jobs: 35 },
      { name: "Customer Service", jobs: 46 },
      { name: "Software Engineering", jobs: 60 },
      { name: "Human Resource HR", jobs: 74 },
      { name: "Accounting", jobs: 20 },
      { name: "Full Stack Developer", jobs: 46 },
      // { name: "Help Center", jobs: 60 },
      // { name: "Project Manager", jobs: 74 },
      // { name: "Business Development", jobs: 20 },
      // { name: "Data Science", jobs: 20 },
    ]);

    return {
      popularJobs,
      categories
    };
  }
};
</script>

<style scoped>
.container {
  max-width: 1200px;
}
.font-serif {
  font-family: serif;
}
</style>
