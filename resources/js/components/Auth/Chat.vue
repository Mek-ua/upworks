<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-4">Chat with {{ recipientName }}</h2>
  
      <!-- Chat History -->
      <div class="mb-4 h-80 overflow-y-auto border-b-2 pb-4">
        <div v-for="message in messages" :key="message.id" :class="{'text-right': message.is_sender}">
          <div class="inline-block px-4 py-2 rounded-lg mb-2" :class="message.is_sender ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700'">
            <p>{{ message.text }}</p>
            <p class="text-xs text-gray-500">{{ message.timestamp }}</p>
          </div>
        </div>
      </div>
  
      <!-- Message Input -->
      <form @submit.prevent="sendMessage" class="flex">
        <input
          v-model="newMessage"
          type="text"
          placeholder="Type a message..."
          class="flex-grow px-4 py-2 border rounded-l focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        />
        <button
          type="submit"
          :disabled="isLoading"
          class="bg-indigo-600 text-white px-4 py-2 rounded-r hover:bg-indigo-700 transition-colors disabled:bg-gray-400"
        >
          <span v-if="isLoading">Sending...</span>
          <span v-else>Send</span>
        </button>
      </form>
  
      <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  const messages = ref([]);
  const newMessage = ref('');
  const isLoading = ref(false);
  const errorMessage = ref('');
  const recipientName = ref('User'); // Set recipient name dynamically
  const route = useRoute();
  const router = useRouter();
  
  const fetchMessages = async () => {
    try {
      const response = await this.$axios.get(`/chats/${route.params.receiverId}/${route.params.receiverRole}`);
      messages.value = response.data;
    } catch (error) {
      console.error("Failed to load chat messages:", error);
      errorMessage.value = "Failed to load messages. Please try again.";
      router.push('/login');
    }
  };
  
  const sendMessage = async () => {
    if (!newMessage.value.trim()) return;
  
    isLoading.value = true;
    errorMessage.value = '';
  
    try {
      const response = await this.$axios.post(`/chats/send`, {
        text: newMessage.value,
        receiver_id: route.params.receiverId,
        receiver_role: route.params.receiverRole,
      });
      messages.value.push(response.data);
      newMessage.value = '';
    } catch (error) {
      console.error("Failed to send message:", error);
      errorMessage.value = "Failed to send message. Please try again.";
    } finally {
      isLoading.value = false;
    }
  };
  
  onMounted(fetchMessages);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  