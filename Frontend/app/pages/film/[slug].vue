<script setup>
import { onMounted } from 'vue'

onMounted(() => {
    if (process.client) {
        setTimeout(() => {
            if (window.Plyr) {
                new window.Plyr('#player')
            } else {
                console.error("Plyr belum ter-load")
            }
        }, 100)
    }
})

const route = useRoute()

// slug dari URL → /films/inception
const slug = route.params.slug

const { data: films, pending, error } = await useFetch(
    `http://localhost:8000/api/films/${slug}`,
)

</script>


<template>
    <section class="section section--details">
        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <h1 class="section__title section__title--head">{{ films.judul }}</h1>
                </div>
                <!-- end title -->

                <!-- content -->
                <div class="col-12 col-xl-6">
                    <div class="item item--details">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-6 col-xxl-5">
                                <div class="item__cover">
                                    <img  :src="films.poster" alt="">
                                    <span class="item__rate item__rate--green">{{ films.rating }}</span>
                                    <button class="item__favorite item__favorite--static" type="button"><i
                                            class="ti ti-bookmark"></i></button>
                                </div>
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-md-7 col-lg-8 col-xl-6 col-xxl-7">
                                <div class="item__content">
                                    <ul class="item__meta">
                                        <li><span>Director:</span> <a href="actor.html">Vince Gilligan</a></li>
                                        <li><span>Cast:</span> <a href="actor.html">Brian Cranston</a> <a
                                                href="actor.html">Jesse Plemons</a> <a href="actor.html">Matt Jones</a>
                                            <a href="actor.html">Jonathan Banks</a> <a href="actor.html">Charles
                                                Baker</a> <a href="actor.html">Tess Harper</a>
                                        </li>
                                        <li><span>Genre:</span> <a href="catalog.html">Action</a>
                                            <a href="catalog.html">Triler</a>
                                        </li>
                                        <li><span>Premiere::</span> {{films.tahun}}</li>
                                        <li><span>Running time:</span>{{films.durasi}}</li>
                                        <li><span>Country:</span> <a href="catalog.html">USA</a></li>
                                    </ul>

                                    <div class="item__description">
                                        <p>{{ films.deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->

                <!-- player -->
                <div class="col-12 col-xl-6">
                    <video controls crossorigin playsinline
                        :poster="films.poster" id="player">
                        <!-- Video files -->
                        <source :src="films.vidio_url"
                            type="video/mp4" size="576">
                        <source :src="films.vidio_url"
                            type="video/mp4" size="720">
                        <source :src="films.vidio_url"
                            type="video/mp4" size="1080">

                        <!-- Caption files -->
                        <track kind="captions" label="English" srclang="en"
                            src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" default>
                        <track kind="captions" label="Français" srclang="fr"
                            src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">

                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                            download>Download</a>
                    </video>
                </div>
                <!-- end player -->
            </div>
        </div>
        <!-- end details content -->
    </section>
</template>