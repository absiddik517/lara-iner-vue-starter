<template>
  <li class="nav-item">
    <inertia-link :href="url" class="nav-link">
      <i class="nav-icon" :class="icon"></i>
      <p>{{ text }}</p>
    </inertia-link>
  </li>
</template>

<script setup>
  
  const props = defineProps({
    url: {
      type: String,
      default: '#'
    }, 
    icon: {
      type: String,
      default: 'far fa-circle'
    },
    text: {
      type: String,
      default: 'Link text'
    }
  })
</script>