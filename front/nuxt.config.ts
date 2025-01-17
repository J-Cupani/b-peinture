import svgLoader from 'vite-svg-loader'
import vuetify from 'vite-plugin-vuetify'
import { fileURLToPath } from 'node:url'
import Compression from 'vite-plugin-compression'

export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  ssr: true,
  routeRules: {
    '/admin/**': { ssr: false },
    '/login': { ssr: false },
    '/': { ssr: true },
    '/mot-de-passe-oublie': { ssr: false },
    '/reinitialiser-mot-de-passe/**': { ssr: false }
  },

  runtimeConfig: {
    apiBaseUrl: process.env.NODE_ENV === 'production' ? process.env.NUXT_PUBLIC_API_BASE_URL : 'https://nginx/v1'
  },

  image: {
    provider: 'none',  // Changer de 'ipx' à 'static'
    format: ['webp', 'jpeg'],
  },

  server: process.env.NODE_ENV === 'production'
  ? {
    host: '0.0.0.0',
    port: 3000,
  }
  : {
    host: '0.0.0.0',
    port: 3000,
    hmr: {
      protocol: 'ws', // Utiliser `ws` en développement
      host: 'localhost', // Le host pour HMR en local
      port: 3000, // Assurez-vous que ce port est disponible
    },
    watch: {
      ignored: ['!**/composables/**', '!**/server/**', '!**/middleware/**'],
    },
  },

  app: {
    head: {
      titleTemplate: '%s',
      title: 'C4dev',
      htmlAttrs: {
        lang: 'fr', // Ajout de l'attribut lang ici
      },
      link: [{
        rel: 'icon',
        type: 'image/x-icon',
        href: process.env.NUXT_APP_BASE_URL ? process.env.NUXT_APP_BASE_URL + '/favicon.ico' : '/favicon.ico'
      }],
    },
  },

  css: [
    '@core/scss/template/index.scss',
    '@styles/styles.scss',
    "bootstrap/scss/bootstrap.scss",
    "swiper/css/bundle",
    "aos/dist/aos.css",
    "~/assets/assets-public/scss/main.scss",
  ],

  devtools: {
    enabled: process.env.NODE_ENV !== 'production',
  },

  components: {
    dirs: [
      {
        path: '@/@core/components',
        pathPrefix: false,
      }, {
        path: '~/components/global',
        global: true,
      }, {
        path: '~/components',
        pathPrefix: false,
      }, {
        path: '~/components/components-public', // Inclut le dossier `components-public`
        pathPrefix: false, // Pas besoin de préfixer les noms des sous-dossiers
      },
    ],
  },

  plugins: ['@/plugins/vuetify/index.js', '@/plugins/iconify/index.js'],

  imports: {
    dirs: ['./@core/utils', './@core/composable/', './plugins/*/composables/*'],
  },

  experimental: {
    typedPages: true,
  },

  typescript: {
    tsConfig: {
      compilerOptions: {
        paths: {
          '@/*': ['../*'],
          '@themeConfig': ['../themeConfig.js'],
          '@layouts/*': ['../@layouts/*'],
          '@layouts': ['../@layouts'],
          '@core/*': ['../@core/*'],
          '@core': ['../@core'],
          '@images/*': ['../assets/images/*'],
          '@styles/*': ['../assets/styles/*'],
          '@validators': ['../@core/utils/validators'],
          '@db/*': ['../server/fake-db/*'],
          '@api-utils/*': ['../server/utils/*'],
        },
      },
    },
  },

  sourcemap: {
    server: false,
    client: false,
  },

  vue: {
    compilerOptions: {
      isCustomElement: tag => tag === 'swiper-container' || tag === 'swiper-slide',
    },
  },

  vite: {
    define: { 'process.env': {} },

    resolve: {
      alias: {
        '@': fileURLToPath(new URL('.', import.meta.url)),
        '@themeConfig': fileURLToPath(new URL('./themeConfig.js', import.meta.url)),
        '@core': fileURLToPath(new URL('./@core', import.meta.url)),
        '@layouts': fileURLToPath(new URL('./@layouts', import.meta.url)),
        '@images': fileURLToPath(new URL('./assets/images/', import.meta.url)),
        '@styles': fileURLToPath(new URL('./assets/styles/', import.meta.url)),
        '@assets-public': fileURLToPath(new URL('./assets/assets-public/', import.meta.url)),
        '@configured-variables': fileURLToPath(new URL('./assets/styles/variables/_template.scss', import.meta.url)),
        '@db': fileURLToPath(new URL('./server/fake-db/', import.meta.url)),
        '@api-utils': fileURLToPath(new URL('./server/utils/', import.meta.url)),
        '@stores': fileURLToPath(new URL('./stores', import.meta.url))
      },
    },

    build: {
      chunkSizeWarningLimit: 5000,
      minify: 'esbuild', // Utilisation de esbuild pour minifier les fichiers
      terser: {
        terserOptions: {
          compress: {
            drop_console: true, // Supprime les logs console
            passes: 2, // Applique plusieurs passes pour optimiser
          },
        },
      },
      rollupOptions: {
        output: {
          manualChunks(id) {
            if (id.includes('node_modules')) {
              return 'vendor';
            }
          },
        },
      },
      postcss: {
        plugins: {
          '@fullhuman/postcss-purgecss': {
            content: [
              './components/**/*.vue',
              './layouts/**/*.vue',
              './pages/**/*.vue',
              './plugins/**/*.js',
              './nuxt.config.js',
              './assets/assets-public/**/*.scss', // Inclure tous les fichiers SCSS
              './assets/assets-public/**/*.css'   // Inclure tous les fichiers CSS
            ],
            safelist: ['html', 'body'], // Classes que tu veux garder
            defaultExtractor(content) {
              return content.match(/[\w-/:]+(?<!:)/g) || []; // Extraction des classes
            }
          }
        }
      },
    },

    optimizeDeps: {
      exclude: ['vuetify'],
      entries: ['./**/*.vue'],
      include: ['wow.js'],

    },
    css: {
      postcss: {
        plugins: [
          require('postcss-preset-env')({ stage: 3 }), // Ajoute des fonctionnalités CSS modernes
          require('autoprefixer')({
            overrideBrowserslist: ['> 1%', 'last 2 versions', 'not dead'], // Ajuste les navigateurs cibles
          }),
          require('cssnano')({
            preset: ['default', { discardComments: { removeAll: true } }],
          }),
        ],
      },
    },

    plugins: [
      svgLoader(),
      vuetify({
        styles: {
          configFile: 'assets/styles/variables/_vuetify.scss',
        },
      }),
      Compression({
        algorithm: 'brotliCompress',
        ext: '.br',
        threshold: 10240, // Ne compresse que les fichiers > 10KB
      }),
      Compression({
        algorithm: 'gzip',
        ext: '.gz',
        threshold: 10240, // Ne compresse que les fichiers > 10KB
      }),
    ],
  },

  build: {
    transpile: ['vuetify'],
    extractCSS: true, // Extrait le CSS en fichiers séparés
    optimization: {
      splitChunks: {
        layouts: true,
        pages: true,
        commons: true,
      },
    },
  },

  // modules: ['@vueuse/nuxt', '@nuxtjs/device', '@pinia/nuxt', "nuxt-particles", "@nuxt/image"],
  modules: ['@vueuse/nuxt', '@nuxtjs/device', '@pinia/nuxt', "nuxt-particles", "@nuxt/image", 'nuxt-beastcss'],

  beastcss: {
    inline: true, // Inline critical CSS
    defer: true,  // Defer non-critical CSS
    enabled: process.env.NODE_ENV === 'production', // Active uniquement en production
  },
})