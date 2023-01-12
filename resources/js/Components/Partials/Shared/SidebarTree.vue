<template>
  <li class="nav-item">
    <a href="#" class="nav-link">
      <slot name="title">
        <i class="nav-icon fas fa-table"></i>
        <p>
            Title
            <i class="fas fa-angle-left right"></i>
        </p>
      </slot>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
      <slot name="links">
        <SidebarLink />
      </slot>
    </ul>
  </li>
</template>

<script setup>
  import SidebarLink from './SidebarLink.vue'
</script>