<script setup>
 import { ref, computed  } from 'vue'
 //import { useForm, usePage } from '@inertiajs/vue3'
 import AudioPlayer from 'vue3-audio-player'
import 'vue3-audio-player/dist/style.css'
  defineProps({
        card : Object,
        backgroundImg: String,
        song:Object
    })

</script>

<template>

    <div class="custom-container">
        <header class="space d-flex justify-content-center">
            <div>
                <h1>Here is your <span class="text-primary">Digi-Card🌹</span></h1>
                <p class="heading-text text-center">Made with love 😍</p>
                <div class="d-flex justify-content-center">
                    <Link href="/" class="btn btn-lg btn-outline-light">Home</Link>
                </div>
            </div>
        </header>
        <div
            class="card-container mb-3 rounded-3 shadow-lg overflow-hidden"
            :style="{
                backgroundImage: `url(${backgroundImg})`,
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                height: '650px'
            }"
            >
            <!-- Overlay for readability -->
            <div class="overlay"></div>

            <!-- Content -->
            <div class="card-content text-center text-white p-4">
                <h2 class="card-title fw-bold mb-3">{{ card.title }}</h2>
                <p class="card-text fs-5 mb-4">{{ card.message }}</p>

                <div class="card-footer mt-auto">
                <span class="fw-light">💌 from <strong>{{ card.sender_name }}</strong> to <strong>{{ card.recipient_name }}</strong></span>
                </div>
            </div>

            <div class="preview-song">
                <AudioPlayer
                    :option="{
                        src: `/storage/${song.file_path}`,
                        title: song.name,
                        coverImage: '/audio-cover.jpg',
                        coverRotate: true
                }"
                />
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>