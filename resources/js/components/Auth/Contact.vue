<template>
  <div class="bg-gray-200 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-transparent sticky top-0 w-full py-4 ml-32 z-50">
      <div class="container mx-auto px-6 lg:px-16 flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <span class="text-3xl font-semibold text-dark text-slate-400">Freelance-Hub</span>
        </div>
        <div class="flex space-x-6">
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
      <div class="absolute inset-0 bg-black bg-opacity-70"></div>
      <div class="relative container mx-auto text-center pt-32">
      <h5 class="text-xl text-slate-600">Get in touch !</h5>
        <h3 class="text-4xl font-bold text-white mb-4">Contact Us</h3>
        <div class="text-white text-sm flex justify-center items-center space-x-2">
          <span class="text-slate-600">Freelance-Hub</span>
          <span class="text-gray-400">→</span>
          <span>Contact Us</span>
        </div>
      </div>
      <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 160L80 149.3C160 139 320 117 480 128C640 139 800 181 960 181.3C1120 181 1280 139 1360 117.3L1440 96V320H1360C1280 320 1120 320 960 320C800 320 640 320 480 320C320 320 160 320 80 320H0Z" fill="#f8f9fa" />
      </svg>
    </section>

    <!-- Contact Form Section -->
    <section class="container mx-auto px-6 lg:px-16 py-16 grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="flex items-center justify-center">
        <!-- Placeholder for an illustration -->
      </div>
      <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-semibold mb-6">Get in touch!</h2>
        <form>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="name" class="block text-sm font-medium mb-2">Your Name <label class="text-red-500 text-lg"> *</label></label>
              <input type="text" id="name" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Name">
            </div>
            <div>
              <label for="email" class="block text-sm font-medium mb-2">Your Email <label class="text-red-500 text-lg"> *</label></label>
              <input type="email" id="email" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Email">
            </div>
          </div>
          <div class="mb-4">
            <label for="subject" class="block text-sm font-medium mb-2">Subject</label>
            <input type="text" id="subject" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Subject">
          </div>
          <div class="mb-4">
            <label for="message" class="block text-sm font-medium mb-2">Comments <label class="text-red-500 text-lg"> *</label></label>
            <textarea id="message" rows="5" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Message"></textarea>
          </div>
          <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Send Message</button>
        </form>
      </div>
    </section>

    <!-- Contact Details Section -->
    <section class="container mx-auto px-6 lg:px-16 py-16">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center">
          <div class="bg-blue-100 p-4 rounded-full mb-4">
            <i class="fas fa-phone-alt text-blue-500 text-2xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-700">Phone</h3>
          <h6 class="text-slate-400">Start working with Freelance-Hub that can provide everything.</h6>
          <p class="text-cyan-600 p-2">+251 939-382-289</p>
        </div>
        <div class="text-center">
          <div class="bg-blue-100 p-4 rounded-full mb-4">
            <i class="fas fa-envelope text-blue-500 text-2xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-slate-700">Email</h3>
          <h6 class="text-gray-400">Start working with Freelance-Hub that can provide everything.</h6>
          <p class="text-cyan-600 p-2">Freelance-Hub@gmail.com</p>
        </div>
        <div class="text-center">
          <div class="bg-blue-100 p-4 rounded-full mb-4">
            <i class="fas fa-map-marker-alt text-blue-500 text-2xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-slate-700">Location</h3>
          <p class="text-gray-400">Ethiopia, Addis Abeba</p>
          <a href="https://goo.gl/maps/your-google-map-link" class="text-blue-500 hover:underline">View on Google map</a>
        </div>
      </div>
    </section>

    <!-- Map Section -->
    <section class="h-64 md:h-96">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.5075833609787!2d38.75438251410539!3d9.025274991519511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b850b5d89b5e1%3A0x83d16a14c4f15b14!2sSaltemhirt%20Church!5e0!3m2!1sen!2set!4v1685587645689!5m2!1sen!2set" class="w-full h-full" allowfullscreen="" loading="lazy"></iframe>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
      <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between text-center lg:text-left">
        <div class="mb-4 lg:mb-0 flex items-center justify-center lg:justify-start">
          <span class="text-slate-300 font-bold text-3xl">Freelance-Hub</span>
        </div>
        <div class="flex space-x-6 justify-center lg:justify-start mb-4 lg:mb-0">
          <a href="#" class="text-gray-200 hover:text-gray-400">Home</a>
          <a href="#" class="text-gray-200 hover:text-gray-400">How it works</a>
          <a href="#" class="text-gray-200 hover:text-gray-400">Create a Job</a>
          <a href="#" class="text-gray-200 hover:text-gray-400">About us</a>
        </div>
        <div class="flex space-x-4 justify-center lg:justify-start">
          <a href="#" class="text-white hover:text-gray-400"><i class="fas fa-shopping-cart"></i></a>
          <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-dribbble"></i></a>
          <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-instagram"></i></a>
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
  name: 'ContactUs'
};
</script>

<style scoped>
.container {
  max-width: 1200px;
}
</style>
