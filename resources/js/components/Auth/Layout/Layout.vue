<template>
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
      <h1 class="text-2xl">Freelance Hub</h1>
      <nav>
        <router-link to="/client-dashboard" class="mr-4">Dashboard</router-link>
        <router-link to="/jobs">Jobs</router-link>
        <router-link to="/contracts">Contracts</router-link>
        <router-link to="/payments">Payments</router-link>
        <router-link to="/notifications">Notifications</router-link>
        <router-link to="/chat">Chat</router-link>
        <button @click="logout" class="ml-4 bg-red-500 p-2 rounded">Logout</button>
      </nav>
    </header>

    <!-- Main Content Area -->
    <div class="flex flex-1">
      <!-- Sidebar -->
      <aside class="w-1/4 bg-gray-200 p-4">
        <p class="font-semibold mb-2">Profile</p>
        <router-link to="/client-profile" class="block mb-2">Client Profile</router-link>
        <router-link to="/freelancer-profile" class="block mb-2">Freelancer Profile</router-link>
        <router-link to="/skills" class="block mb-2">Manage Skills</router-link>
        <router-link to="/educational-status" class="block">Educational Status</router-link>
      </aside>

      <!-- Dynamic Content Loaded Here -->
      <main class="w-3/4 p-6">
        <router-view></router-view>
      </main>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();

const logout = () => {
  localStorage.removeItem('token');
  localStorage.removeItem('role');
  alert("You have been logged out.");
  router.push('/login');
};
</script>

<style scoped>
/* Additional styles if needed */
</style>
