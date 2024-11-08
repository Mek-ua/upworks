<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center">
      <h1 class="text-3xl font-semibold mb-8">Join as a client or freelancer</h1>
      <div class="flex justify-center space-x-6">
        <div
          @click="selectRole(2)"
          :class="{'border-2 border-indigo-600': selectedRole === 2}"
          class="p-6 border rounded cursor-pointer hover:shadow-lg transition-all"
          role="button"
          aria-selected="true"
          tabindex="0"
        >
          <p class="text-lg font-medium">I’m a client, hiring for a project</p>
        </div>
        <div
          @click="selectRole(3)"
          :class="{'border-2 border-indigo-600': selectedRole === 3}"
          class="p-6 border rounded cursor-pointer hover:shadow-lg transition-all"
          role="button"
          aria-selected="false"
          tabindex="0"
        >
          <p class="text-lg font-medium">I’m a freelancer, looking for work</p>
        </div>
      </div>
      <button
        @click="proceedToRegister"
        :disabled="!selectedRole"
        class="mt-6 px-6 py-2 bg-indigo-600 text-white rounded disabled:bg-gray-400"
      >
        Create Account
      </button>
      <p class="mt-4">
        Already have an account? <router-link to="/login" class="text-indigo-600">Log In</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const selectedRole = ref(null);
const router = useRouter();

const selectRole = (role) => {
  selectedRole.value = role;
};

const proceedToRegister = () => {
  if (selectedRole.value) {
    router.push({ name: 'Register', query: { role_id: selectedRole.value } });
  }
};
</script>

<style scoped>
/* Add any additional styling if needed */
</style>
