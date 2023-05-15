module.exports = {
  extends: [
    "plugin:@typescript-eslint/recommended",
    "plugin:vue/vue3-recommended",
    "prettier",
    "plugin:promise/recommended",
  ],
  'prettier/prettier': [
    'error',
    { 'endOfLine': 'auto' }
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
    "arrow-parens": ["warn", "as-needed", { "requireForBlockBody": true }],
    "brace-style": ["warn", "stroustrup"],
    "comma-dangle": ["warn", "never"],
    "complexity": ["warn", 10],
    "import/prefer-default-export": "off",
    "import/no-cycle": ["error", { "maxDepth": 1 }],
    "import/no-extraneous-dependencies": ["warn", { "devDependencies": true }],
    "max-depth": ["warn", 3],
    "max-len": ["warn", {
      "code": 120,
      "ignoreComments": true,
      "ignoreStrings": true,
      "ignoreTemplateLiterals": true,
      "ignoreTrailingComments": true,
      "ignoreUrls": true,
      "ignorePattern": "as "
    }],
    "max-statements": ["warn", 30],
    "endOfLine": 'on',
    "no-warning-comments": [1, { terms: ["todo", "fixme"] }],
    "no-console": "warn",
    "no-multiple-empty-lines": ["error", { "max": 1, "maxEOF": 0, "maxBOF": 0 }],
    "no-undef": "warn",
    "no-underscore-dangle": "warn",
    "quote-props": "off",
    "semi": ["warn", "always"],
    "object-curly-newline": ["error", {
      "ImportDeclaration": "never",
      "ExportDeclaration": "never"
    }],
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
  },
  reportUnusedDisableDirectives: true,
  ignorePatterns: ["node_modules", "/dist", "/client/dist"],
  overrides: [
    {
      files: ["./**/*.vue"],
      rules: {
        "vue/multi-word-component-names": "off",
      },
    },
  ],
};
