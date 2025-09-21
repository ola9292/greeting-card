<script setup>
    import { ref, computed, onMounted  } from 'vue'
    import { useForm, usePage, Link } from '@inertiajs/vue3'
    import AudioPlayer from 'vue3-audio-player'
    import 'vue3-audio-player/dist/style.css'
    import 'vue3-carousel/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

const carouselConfig = {
  itemsToShow: 1,
  wrapAround: true
}
    const props = defineProps({
        backgrounds : Array,
        songs: Array
    })

    const base_url = window.location.origin;


    const backgroundImg = ref('')
    const backgroundSong = ref('')
    const page_url = ref(null)
    const page = usePage()
    const flashData = computed(() => page.props.flash)

    const filteredBackgrounds = computed(() => {
        if (!form.occasion) return [] // show nothing until selected
        return props.backgrounds.filter(bg => bg.occasion === form.occasion)
        })
const form = useForm({
  occasion: "",
  background_id: null,
  title: null,
  message: null,
  sender_name: null,
  recipient_name: null,
  song_id: null,
  slug: null,
})

const setBackground = (img) => {
    form.background_id = img.id
    backgroundImg.value = img.file_path
}
const setSongId = (song) => {
    form.song_id = song.id
    backgroundSong.value = song
}

const copyLink = () => {
     const link = `${base_url}/card/${page.props.flash.card_slug}`
    navigator.clipboard.writeText(link).then(() => {
    alert("Copied the link: " + link)
  })
}

const handleSubmit = () => {
    form.post('/card/create', {
        onSuccess: (page) => {
            page_url.value =  window.location.href

        }
    })
}

onMounted(() => {

})
</script>

<template>

    <div class="custom-container">
        <header class="space d-flex justify-content-center">
            <div>
                <h1>Create Your <span class="text-primary">Digi-Card🌹</span></h1>
                <p class="heading-text text-center">Customize a card for your loved ones 💏</p>
                <div class="d-flex justify-content-center">
                    <Link href="/" class="btn btn-lg btn-outline-light me-2">Home</Link>
                    <Link href="/" class="btn btn-lg btn-outline-light">Buy me <i class="fa-solid fa-mug-hot"></i></Link>
                </div>
            </div>
        </header>


        <div class="grid-container">
            <section class="grid-item">
                <form action="" @submit.prevent="handleSubmit">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">🎁 Occasion</label>
                        <select name="occasion" class="form-select" id="" v-model='form.occasion'>
                            <option disabled value="">Please select one</option>
                            <option value="birthday">Birthday</option>
                            <option value="anniversary">Anniversary</option>
                            <option value="valentine">Valentine</option>
                        </select>
                        <div v-if="form.errors.occasion" class="text-danger">{{ form.errors.occasion }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">👱‍♂️ Sender Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="john" v-model="form.sender_name">
                        <div v-if="form.errors.sender_name" class="text-danger">{{ form.errors.sender_name }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">👩🏾‍🦰 Recipient Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="sarah" v-model="form.recipient_name">
                        <div v-if="form.errors.recipient_name" class="text-danger">{{ form.errors.recipient_name }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">🍀 Message Title</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Happy Anniversary" v-model="form.title">
                        <div v-if="form.errors.title" class="text-danger">{{ form.errors.title }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">📩 Message</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Your heartfelt message here..." v-model="form.message"></textarea>
                        <div v-if="form.errors.message" class="text-danger">{{ form.errors.message }}</div>
                    </div>

                    <div class="backgrounds" v-if="filteredBackgrounds.length > 0">

                        <div
                            v-for="bg in filteredBackgrounds"
                            :key="bg.id"
                            class="background-option"
                            :class="{ selected: form.background_id === bg.id }"
                            @click="setBackground(bg)"
                        >
                            <img class="rounded" :src="`${bg.file_path}`" :alt="bg.name" loading="lazy" width="230" height="150"/>
                        </div>
                        <div v-if="form.errors.background_id" class="text-danger">{{ form.errors.background_id }}</div>
                    </div>


                     <!-- <AudioPlayer
                        v-for="song in songs"
                        :key="song.id"
                        @click="setSongId(song)"
                        :option="{
                            src: `/storage/${song.file_path}`,
                            title: 'your-audio-title',
                            coverImage: '/audio-cover.jpg',
                            coverRotate: true
                    }"
                    /> -->
                    <div class="mt-3">
                        <label for="exampleFormControlTextarea1" class="form-label">📀 Background Music</label>
                        <div class="carousel pt-3 pb-3">
                            <Carousel v-bind="carouselConfig">
                                <Slide v-for="song in songs" :key="song.id">
                                    <div class="carousel__item">
                                        <AudioPlayer
                                            @click="setSongId(song)"
                                            :option="{
                                                src: `/storage/${song.file_path}`,
                                                title: song.name,
                                                coverImage: '/audio-cover.jpg',
                                                coverRotate: true
                                        }"
                                        />
                                    </div>
                                </Slide>
                                <template #addons>
                                    <Navigation />
                                    <!-- <Pagination /> -->
                                </template>
                            </Carousel>
                        </div>
                    </div>




                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-lg btn-outline-success" type="submit">Get Your Digital Card Link</button>
                    </div>
                </form>

                <div v-if="page.props.flash.card_slug" class="alert alert-success mt-3" role="alert">
                  <i class="fa-solid fa-clone" @click=copyLink></i> <span id="card-link">{{ base_url }}/card/{{ page.props.flash.card_slug }}</span>
                </div>

                <div class=" d-grid gap-2 mt-3">
                    <button class="preview-button btn btn-lg btn-success" type="button">
                        <a href="#preview">See Preview </a>
                    </button>
                </div>
            </section>

            <section class="grid-item">
                <div class="text-center">
                    <h2>✨ Live Preview</h2>
                </div>

                <div
                    id="preview"
                    class="card-container mb-3 h-75 rounded-3 shadow-lg overflow-hidden"
                    :style="{
                        backgroundImage: `url(${backgroundImg})`,
                        backgroundSize: 'cover',
                        backgroundPosition: 'center'
                    }"
                    >
                    <!-- Overlay for readability -->
                    <div class="overlay"></div>

                    <!-- Content -->
                    <div class="card-content text-center text-white p-4">
                        <h2 class="card-title fw-bold mb-3">{{ form.title }}</h2>
                        <p class="card-text fs-5 mb-4">{{ form.message }}</p>

                        <div class="card-footer mt-auto">
                        <span class="fw-light">💌 from <strong>{{ form.sender_name }}</strong> to <strong>{{ form.recipient_name }}</strong></span>
                        </div>
                    </div>
                    <div class="preview-song">
                        <AudioPlayer
                            v-if="backgroundSong"
                            :option="{
                                src: `/storage/${backgroundSong.file_path}`,
                                title: backgroundSong.name,
                                coverImage: '/audio-cover.jpg',
                                coverRotate: true
                        }"
                        />
                    </div>
                </div>

            </section>
        </div>

    </div>

</template>

<style scoped>
    .selected{
        border:2px solid #fff;
        border-radius: 10px;
    }
    .backgrounds{
        background: #44444E;
        display:grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap:8px;
        padding: 10px;
        border-radius: 10px;
    }

</style>