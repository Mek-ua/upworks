<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Notifications</h2>
  
      <div v-if="notifications.length">
        <ul>
          <li v-for="notification in notifications" :key="notification.id" class="border-b py-4">
            <div class="flex justify-between items-center">
              <div>
                <p class="text-gray-700">{{ notification.message }}</p>
                <p class="text-gray-500 text-sm">Date: {{ notification.timestamp }}</p>
              </div>
              <div class="flex space-x-2">
                <button
                  v-if="!notification.seen"
                  @click="markAsSeen(notification.id)"
                  class="text-blue-600 hover:underline"
                >
                  Mark as Seen
                </button>
                <button
                  @click="deleteNotification(notification.id)"
                  class="text-red-600 hover:underline"
                >
                  Delete
                </button>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div v-else>
        <p class="text-gray-600">You have no notifications.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const notifications = ref([]);
  const isLoading = ref(false);
  
  const fetchNotifications = async () => {
    try {
      const response = await this.$axios.get('/notifications');
      notifications.value = response.data;
    } catch (error) {
      console.error("Failed to load notifications:", error);
    }
  };
  
  const markAsSeen = async (id) => {
    try {
      await this.$axios.patch(`/notifications/${id}/seen`);
      const notification = notifications.value.find(n => n.id === id);
      if (notification) {
        notification.seen = true;
      }
    } catch (error) {
      console.error("Failed to mark notification as seen:", error);
    }
  };
  
  const deleteNotification = async (id) => {
    try {
      await this.$axios.delete(`/notifications/${id}`);
      notifications.value = notifications.value.filter(n => n.id !== id);
    } catch (error) {
      console.error("Failed to delete notification:", error);
    }
  };
  
  onMounted(fetchNotifications);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  