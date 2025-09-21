<script setup>
</script>

<template>
  <div class="home-container">
    <div class="overlay"></div>
    <div class="inner-wrapper">
      <h1 class="title">Send Beautiful Digital Greeting Cards 🎉</h1>
      <p class="subtitle">
        Create and share personalized cards with your loved ones in just a few clicks.
      </p>
      <a href="/card/create" class="cta-btn">Create Your Card</a>
    </div>
  </div>
</template>

<style scoped>
.home-container {
  position: relative;
  height: 100vh;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  text-align: center;
  color: #fff;
}

.overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
}

.inner-wrapper {
  position: relative;
  z-index: 2;
  max-width: 700px;
  padding: 20px;
}

.title {
  font-size: 3rem;
  font-weight: bold;
  margin-bottom: 1rem;
}

.subtitle {
  font-size: 1.25rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

.cta-btn {
  display: inline-block;
  background: #ff6f61;
  padding: 14px 28px;
  border-radius: 30px;
  color: #fff;
  font-weight: 600;
  font-size: 1.1rem;
  text-decoration: none;
  transition: all 0.3s ease;
}

.cta-btn:hover {
  background: #ff3b2e;
  transform: scale(1.05);
}
</style>
