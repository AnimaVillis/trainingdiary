module.exports = {
  extends: [
    "plugin:@typescript-eslint/recommended",
    "plugin:vue/vue3-recommended",
    "prettier",
    "plugin:promise/recommended",
  ],
  parser: "vue-eslint-parser",
  parserOptions: {
    parser: "@typescript-eslint/parser",
    sourceType: "module",
  },
  plugins: ["@typescript-eslint", "prettier", "promise"],
  root: true,
  rules: {
    "prettier/prettier": 2,
    "no-warning-comments": [1, { terms: ["todo", "fixme"] }],
    quotes: ["error", "double"],
    "vue/html-self-closing": [
      "error",
      {
        html: {
          void: "always",
          normal: "always",
          component: "always",
        },
        svg: "always",
        math: "always",
      },
    ],
    "import/prefer-default-export": "off",
  },
  reportUnusedDisableDirectives: true,
  ignorePatterns: ["node_modules", "/dist", "/client/dist"],
  overrides: [
    {
      files: ["frontend/pages/**/*.vue"],
      rules: {
        "vue/multi-word-component-names": "off",
      },
    },
  ],
};
