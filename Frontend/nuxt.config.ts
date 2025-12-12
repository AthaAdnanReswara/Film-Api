// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  css: [
    '~/assets/css/bootstrap.min.css',
    '~/assets/css/splide.min.css',
    '~/assets/css/slimselect.css',
    '~/assets/css/plyr.css',
    '~/assets/css/photoswipe.css',
    '~/assets/css/default-skin.css',
    '~/assets/css/main.css'
  ],
  app: {
    head: {
      link: [
        
        {
          rel: "stylesheet",
          href: "/webfont/tabler-icons.min.css"
        }
      ],
      script: [
        { src: '/js/bootstrap.bundle.min.js', defer: true, tagPosition: 'bodyClose' },
        { src: '/js/splide.min.js', defer: true, tagPosition: 'bodyClose' },
        { src: '/js/slimselect.min.js', defer: true, tagPosition: 'bodyClose' },
        { src: '/js/smooth-scrollbar.js', defer: true, tagPosition: 'bodyClose' },
        { src: '/js/plyr.min.js', defer: true, tagPosition: 'bodyClose' },
        { src: '/js/photoswipe.min.js', defer: true, tagPosition: 'bodyClose' },
        { src: '/js/photoswipe-ui-default.min.js', defer: true, tagPosition: 'bodyClose' },
        { src: '/js/main.js', defer: true, tagPosition: 'bodyClose' },
      ]
    }
  }
})