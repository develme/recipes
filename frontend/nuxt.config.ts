// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  compatibilityDate: "2024-10-26",

  runtimeConfig: {
    env: process.env.APP_ENV,
    apiUrl: process.env.API_URL,
  },

  modules: ["@nuxt/eslint"],
});