import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
const { resolve, sep } = require('path')
import { fileURLToPath, URL } from 'url'
import { dirname } from 'path'
import commonjs from 'vite-plugin-commonjs'

const HOST = 'localhost'
const PORT = 3000

const __filename = fileURLToPath(import.meta.url)
const __dirname = dirname(__filename)

// find theme dir name
const getThemeDir = () => {
  const _path = process.cwd().split(sep)
  return _path[_path.length - 1]
}

export default defineConfig({
  plugins: [
    commonjs(),
    liveReload(__dirname+'/**/*.php')
  ],

  // config
  root: '',
  base:
    process.env.NODE_ENV === 'development'
      ? `/wp-content/themes/${getThemeDir()}/`
      : `/wp-content/themes/${getThemeDir()}/dist/`,

  build: {
    // output dir for production build
    outDir: resolve(__dirname, './dist'),
    emptyOutDir: true,

    // emit manifest so PHP can find the hashed files
    manifest: true,

    // esbuild target
    target: 'es2018',

    // our entry
    rollupOptions: {
      input: {
        main: resolve( __dirname + '/main.js')
      },
      output: {
        assetFileNames: (assetInfo) => {
          console.log(assetInfo.name)
          let extType = assetInfo.name.split('.').at(1);
          if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
            extType = 'img';
          }
          console.log('extType', extType)
          return `assets/${extType}/[name]-[hash][extname]`;
        },
        chunkFileNames: 'assets/js/[name]-[hash].js',
        entryFileNames: 'assets/js/[name]-[hash].js',
      }
    },

    // minifying switch
    minify: true,
    write: true
  },

  server: {
    // required to load scripts from custom host
    cors: true,

    // we need a strict port to match on PHP side
    // change freely, but update in your functions.php to match the same port
    strictPort: true,
    port: PORT,

    // serve over http
    https: false,
    hmr: {
      port: PORT,
      host: HOST,
    },
  },
  resolve: {
    alias: {
      '@': resolve(__dirname, './'),
    }
  }
})

