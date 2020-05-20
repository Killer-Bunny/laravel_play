<template>
  <div class="text-center error">
    <i class="far fa-thumbs-up fa-9x"></i>
    <h1 class="mt-4">Success!</h1>
    <h2><slot></slot></h2>
  </div>
</template>

<style scoped>
  .success {
    color: #999;
    font-size: 10rem;
  }
</style>
