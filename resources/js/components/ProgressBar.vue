<template>
    <div class="progress-container mb-8">
      <div class="progress-bar" :style="{ width: completionRatio + '%' }">
        <span class="progress-label">{{ completionRatio }}%</span>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      completionRatio: {
        type: Number,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  .progress-container {
    width: 100%;
    background-color: #cbd5e0;
    border-radius: 999px;
    height: 15px;
  }
  
  .progress-bar {
    position: relative;
    background-color: #537188;
    border-radius: 999px;
    height: 100%;
  }
  
  .progress-label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-weight: 600;
    font-size: small;
  }
  </style>
  