// @ts-check
import withNuxt from "./.nuxt/eslint.config.mjs";

export default withNuxt().override("nuxt/vue/rules", {
  rules: {
    "vue/component-name-in-template-casing": ["error", "kebab-case"],
    "vue/html-self-closing": "off",
  },
});
