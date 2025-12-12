<script setup>
definePageMeta({
    ssr: false,
    layout: "default"
})

const { data: films, pending, error } = await useFetch('http://127.0.0.1:8000/api/films')
</script>

<template>

    <!-- content -->
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Recently updated</h2>
                        <!-- end content title -->

                        <!-- content tabs nav -->
                        <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1"
                                    type="button" role="tab" aria-controls="tab-1" aria-selected="true">New
                                    items</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button id="2-tab" data-bs-toggle="tab" data-bs-target="#tab-2" type="button" role="tab"
                                    aria-controls="tab-2" aria-selected="false">Movies</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button id="3-tab" data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab"
                                    aria-controls="tab-3" aria-selected="false">TV Shows</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button id="4-tab" data-bs-toggle="tab" data-bs-target="#tab-4" type="button" role="tab"
                                    aria-controls="tab-4" aria-selected="false">Anime</button>
                            </li>
                        </ul>
                        <!-- end content tabs nav -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab" tabindex="0">
                    <div class="row">

                        <div v-if="pending" class="text-center text-danger">
                            Loading...
                        </div>
                        <div v-if="error" class="text-center text-danger">
                            gagal mengambil data...
                        </div>
                        <!-- item -->
                        <div v-for="film in films" :key="film.id" class="col-6 col-sm-4 col-lg-3 col-xl-2">
                            <div class="item">
                                <div class="item__cover">
                                    <img :src="film.poster" alt="">
                                    <NuxtLink :to="`/film/${film.slug}`" class="item__play">
                                        <i class="ti ti-player-play-filled"></i>
                                    </NuxtLink>
                                    <span class="item__rate item__rate--green">{{ film.rating }}</span>
                                    <button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
                                </div>
                                <div class="item__content">
                                    <h3 class="item__title"><a href="details.html">{{ film.judul }}</a></h3>
                                    <span class="item__category">
                                        <NuxtLink :to="`/film/${film.slug}`" class="item__play">{{ film.category.nama_category }}</NuxtLink>
                                        <p class="text-sm text-secondary">{{ film.deskripsi }}</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->
                    </div>
                </div>
                <!-- end content tabs -->
                <div class="row">
                    <!-- more -->
                    <div class="col-12">
                        <a class="section__more" href="catalog.html">View all</a>
                    </div>
                    <!-- end more -->
                </div>
            </div>
        </div>
    </section>
    <!-- end content -->

</template>