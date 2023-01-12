<template>
  <button @click="handelClick" :key="buttonKey" :type="type" :disabled="isLoading" class="btn" :class="classes">
    <slot>Submit</slot> <Spinner v-if="clicked" :show="isLoading" />
  </button>
</template>

<script setup>
  import { onMounted, onUnmounted, ref  } from 'vue'
  import Spinner from './../Kit/Spinner.vue'
  import helper from '@/Store/functions.js'
  import { Inertia } from '@inertiajs/inertia'

  const props = defineProps({
    type: {
      type: String,
      default: 'submit',
    },
    isLoading: {
      type: Boolean,
      default: false
    },
    uppercase: {
      type: Boolean,
      default: true
    },
    varient: {
      type: String,
      default: 'dark'
    },
    class: {
      type: String,
      default: ''
    },
    size: {
      type: String,
      default: null
    },
    spinner: {
      type: Boolean,
      default: true
    },
  })
  
  const classes = ref('');
  const buttonKey = ref('');
  const clicked = ref(false);
  
  onMounted(() => {
    let classesArray = [];
    classesArray.push(`btn-${props.varient}`);
    classesArray.push(`${props.class}`);
    classesArray.push(props.size ? `btn-${props.size}` : '');
    classesArray.push(props.uppercase ? `text-uppercase` : '');
    classes.value = classesArray.join(' ');
    buttonKey.value = helper.uniqueKey();
  })
  
  const handelClick = () => {
    clicked.value = true;
  }
  
  const removeEventListener = Inertia.on('finish', () => {
    clicked.value = false;
  })
  
  onUnmounted(() => removeEventListener())
  
</script>
