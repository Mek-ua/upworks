<template>
    <div class="relative bg-gray-200">
    <!-- Navbar -->
    <nav class="bg-transparent sticky top-0 w-full py-4 ml-32 z-50">
        <div class="container mx-auto px-6 lg:px-16 flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <span class="text-3xl font-semibold text-dark text-slate-400">Freelance-Hub</span>
        </div>
        <div class="flex space-x-6 ">
          <a href="/" class="text-slate-400 hover:text-blue-300">Home</a>
          <a href="/about" class="text-slate-400 hover:text-blue-300">About</a>
          <a href="/contactus" class="text-slate-400 hover:text-blue-300">Contact Us</a>
        </div>
        <div class="flex space-x-4 ml-48">
          <a href="/login" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300">Login</a>
          <a href="/signup" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300">Sign Up</a>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center py-64" style="background-image: url('/images/hero/bg.jpg');">
      <!-- Overlay -->
      <div class="absolute inset-0 bg-black bg-opacity-70"></div>
      <!-- Content -->
      <div class="relative container mx-auto text-center pt-32">
        <h1 class="text-4xl font-bold text-white mb-4">About Us</h1>
        <div class="text-white text-sm flex justify-center items-center space-x-2">
          <span class="text-slate-700">Freelance-Hub</span>
          <span class="text-gray-400">→</span>
          <span>About Us</span>
        </div>
      </div>
      <!-- Curved SVG for bottom edge -->
      <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 160L80 149.3C160 139 320 117 480 128C640 139 800 181 960 181.3C1120 181 1280 139 1360 117.3L1440 96V320H1360C1280 320 1120 320 960 320C800 320 640 320 480 320C320 320 160 320 80 320H0Z" fill="#f8f9fa"/>
      </svg>
    </section>
      <!-- Welcome Message -->
      <section class="py-16">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
          <div class="lg:w-1/2 mb-8 lg:mb-0">
            <!-- <img src="/images/happy-team.jpg" alt="Our Team" class="rounded-lg shadow-lg w-full"> -->
          </div>
          <div class="lg:w-1/2 lg:pl-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Millions of jobs. Find the one that's right for you.</h2>
            <p class="text-gray-600 mb-6">
              Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 30,000+ companies worldwide.
            </p>
            <ul class="text-gray-700 mb-6 space-y-2">
              <li><span class="text-blue-500 mr-2">✔️</span>Digital Marketing Solutions for Tomorrow</li>
              <li><span class="text-blue-500 mr-2">✔️</span>Our Talented & Experienced Marketing Agency</li>
              <li><span class="text-blue-500 mr-2">✔️</span>Create your own skin to match your brand</li>
            </ul>
            <button class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600 shadow-md transition duration-300">ABOUT US →</button>
          </div>
        </div>
      </section>
  
      <!-- Why Choose Us -->
      <section class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
          <h2 class="text-4xl font-semibold text-gray-800 mb-8">Here's why you'll love it at Freelance-Hub</h2>
          <p class="text-gray-600 mb-12">Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 30,000+ companies worldwide.</p>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition duration-300">
              <div class="mb-4"><i class="fas fa-headset text-blue-500 text-4xl"></i></div>
              <h3 class="text-xl font-bold text-gray-800 mb-2">24/7 Support</h3>
              <p class="text-gray-600">Many desktop publishing packages and web page editors now use a search for job.</p>
              <a href="#" class="text-blue-500 mt-4 inline-block">Read More →</a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition duration-300">
              <div class="mb-4"><i class="fas fa-laptop-code text-blue-500 text-4xl"></i></div>
              <h3 class="text-xl font-bold text-gray-800 mb-2">Tech & Startup Jobs</h3>
              <p class="text-gray-600">Search all the open positions and find the best opportunities tailored to you.</p>
              <a href="#" class="text-blue-500 mt-4 inline-block">Read More →</a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition duration-300">
              <div class="mb-4"><i class="fas fa-clock text-blue-500 text-4xl"></i></div>
              <h3 class="text-xl font-bold text-gray-800 mb-2">Save Time</h3>
              <p class="text-gray-600">Get your own personalized salary estimate and read reviews on over 30,000 companies.</p>
              <a href="#" class="text-blue-500 mt-4 inline-block">Read More →</a>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Team Section -->
      <section class="py-16 text-center">
        <div class="container mx-auto text-center">
          <h2 class="text-4xl font-semibold text-gray-800 mb-6 text-center">Our Minds</h2>
          <p class="text-gray-600 mb-12">Meet the people who make everything possible at Freelance-Hub.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            <div class="flex flex-col text-center">
              <!-- <img src="/images/team-member1.jpg" alt="Team Member" class="w-32 h-32 rounded-full mb-4 shadow-lg items-center"> -->
              <h3 class="text-xl font-bold text-gray-800  text-center">Jack John</h3>
              <p class="text-gray-600 text-center">Job Seeker</p>
            </div>
           
            
           
          </div>
        </div>
      </section>
  
      <!-- FAQ Section -->
      <section class="py-16 bg-gray-100">
        <div class="container mx-auto">
          <h2 class="text-4xl font-semibold text-gray-800 mb-8 text-center">Questions & Answers</h2>
          <p class="text-center text-gray-600 mb-12">Find answers to frequently asked questions to help you get started.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
              <h3 class="text-xl font-semibold text-blue-900 mb-2">How does Freelance-Hub work?</h3>
              <p class="text-gray-600">Freelance-Hub connects talented professionals with businesses seeking their skills. Discover opportunities and grow your career.</p>
            </div>
            <div>
              <h3 class="text-xl font-semibold text-blue-900 mb-2">Is Freelance-Hub safe to use?</h3>
              <p class="text-gray-600">Yes, we ensure all user data is secure and private. We are committed to providing a safe platform for all our users.</p>
            </div>
            <div>
              <h3 class="text-xl font-semibold text-blue-900 mb-2">How do I apply for jobs?</h3>
              <p class="text-gray-600">Simply sign up, create your profile, and start applying to jobs that match your skills.</p>
            </div>
            <div>
              <h3 class="text-xl font-semibold text-blue-900 mb-2">What types of jobs are available?</h3>
              <p class="text-gray-600">Freelance-Hub offers a wide range of job types including full-time, part-time, and remote work across various industries.</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Contact Section -->
      <section class="py-16">
        <div class="container mx-auto text-center">
          <h2 class="text-4xl font-semibold text-gray-800 mb-4">Have a Question? Get in Touch!</h2>
          <p class="text-gray-600 mb-6">Start working with Freelance-Hub to unlock opportunities and connect with industry professionals.</p>
          <button class="bg-blue-500 text-white px-8 py-3 rounded-full hover:bg-blue-600 shadow-md transition duration-300">CONTACT US</button>
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
  export default {
    name: 'About'
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 1200px;
  }
  </style>
  