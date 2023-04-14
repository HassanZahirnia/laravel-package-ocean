module.exports = {
    env: {
        browser: true,
        es2021: true,
        node: true,
    },
    extends: [
        'eslint:recommended',
        'plugin:import/recommended',
        'plugin:vue/vue3-recommended',
        'plugin:@typescript-eslint/recommended',
        'plugin:jsonc/recommended-with-jsonc',
    ],
    overrides: [
        {
            files: ['*.json', '*.json5'],
            parser: 'jsonc-eslint-parser',
            rules: {
                'jsonc/quotes': ['error', 'double'],
                'jsonc/quote-props': ['error', 'always'],
                'jsonc/comma-dangle': ['error', 'never'],
                'jsonc/indent': ['error', 4],
            },
        },
        {
            files: ['*.vue'],
            parser: 'vue-eslint-parser',
            parserOptions: {
                parser: '@typescript-eslint/parser',
            },
            rules: {
                'no-unused-vars': 'off',
                '@typescript-eslint/no-unused-vars': 'off',
                'no-unused-imports': 'off',
                'unused-imports/no-unused-imports': 'off',
                'unused-imports/no-unused-vars': 'off',
                '@typescript-eslint/no-unused-imports': 'off',
            },
            globals: {
                defineProps: 'readonly',
                defineEmits: 'readonly',
                defineExpose: 'readonly',
                withDefaults: 'readonly',
                defineOptions: 'readonly',
            },
        },
    ],
    parserOptions: {
        ecmaVersion: 'latest',
        parser: '@typescript-eslint/parser',
        sourceType: 'module',
    },
    ignorePatterns: [
        'types/*.d.ts',
    ],
    plugins: [
        'vue',
        'unicorn',
        '@typescript-eslint',
        'import-newlines',
    ],
    settings: {
        'import/resolver': {
            node: { extensions: ['.js', '.mjs', '.ts', '.d.ts'] },
        },
    },
    rules: {
        'no-trailing-spaces': 'error',
        'import-newlines/enforce': [
            'error',
            4,
            120,
        ],
        'keyword-spacing': ['error', { before: true, after: true }],

        // Use 'type' when importing TS typings
        '@typescript-eslint/consistent-type-imports': 'error',

        // Import
        'import/named': 'off', // bugged
        'import/order': 'error',
        'import/first': 'error',
        'import/no-mutable-exports': 'error',
        'import/no-unresolved': 'off',
        'import/no-absolute-path': 'off',
        'import/no-unassigned-import': 'off',

        // Common
        'semi': ['error', 'never'],
        'curly': ['error', 'multi-or-nest', 'consistent'],
        'quotes': ['error', 'single', { avoidEscape: true }],
        'quote-props': ['error', 'consistent-as-needed'],
        'no-unused-vars': 'warn',
        'no-param-reassign': 'off',
        'no-undef': 'off', // too many false positivies
        'array-bracket-spacing': ['error', 'never'],
        'brace-style': ['error', 'stroustrup', { allowSingleLine: true }],
        'block-spacing': ['error', 'always'],
        'camelcase': 'off',
        'comma-spacing': [
            'error',
            {
                before: false,
                after: true,
            },
        ],
        'comma-style': ['error', 'last'],
        'comma-dangle': ['error', 'always-multiline'],
        'no-constant-condition': 'warn',
        'no-debugger': 'error',
        'no-console': ['error', { allow: ['warn', 'error'] }],
        'no-cond-assign': ['error', 'always'],
        'func-call-spacing': ['off', 'never'],
        'key-spacing': [
            'error',
            {
                beforeColon: false,
                afterColon: true,
            },
        ],
        'indent': [
            'error',
            4,
            {
                SwitchCase: 1,
                VariableDeclarator: 1,
                outerIIFEBody: 1,
            },
        ],
        'no-restricted-syntax': ['error', 'DebuggerStatement', 'LabeledStatement', 'WithStatement'],
        'object-curly-spacing': ['error', 'always'],
        'no-return-await': 'off',
        'space-before-function-paren': ['error', 'never'],

        // Linebreak
        'linebreak-style': [
            'error',
            'unix',
        ],

        // Vue
        'vue/html-indent': ['error', 4, {
            closeBracket: 1,
        }],
        'vue/html-self-closing': ['error', {
            html: {
                void: 'always',
                normal: 'always',
                component: 'always',
            },
            svg: 'always',
            math: 'always',
        }],
        'vue/component-tags-order': ['error', {
            order: ['script', 'template', 'style'],
        }],
        'vue/multi-word-component-names': 'off',
        'vue/array-bracket-spacing': ['error', 'never'],
        'vue/array-bracket-newline': ['error', {
            multiline: true,
            minItems: 3,
        }],
        'vue/object-curly-spacing': ['error', 'always'],
        'vue/object-shorthand': ['error', 'always'],
        'vue/object-curly-newline': ['error', { multiline: true, consistent: true }],

        // Unicorns
        // Pass error message when throwing errors
        'unicorn/error-message': 'error',
        // Uppercase regex escapes
        'unicorn/escape-case': 'error',
        // Array.isArray instead of instanceof
        'unicorn/no-instanceof-array': 'error',
        // Prevent deprecated `new Buffer()`
        'unicorn/no-new-buffer': 'error',
        // Keep regex literals safe!
        'unicorn/no-unsafe-regex': 'off',
        // Lowercase number formatting for octal, hex, binary (0x1'error' instead of 0X1'error')
        'unicorn/number-literal-case': 'error',
        // includes over indexOf when checking for existence
        'unicorn/prefer-includes': 'error',
        // String methods startsWith/endsWith instead of more complicated stuff
        'unicorn/prefer-string-starts-ends-with': 'error',
        // textContent instead of innerText
        'unicorn/prefer-text-content': 'error',
        // Enforce throwing type error when throwing error while checking typeof
        'unicorn/prefer-type-error': 'error',
        // Use new when throwing error
        'unicorn/throw-new-error': 'error',
        // Enforce using node: protocol
        'unicorn/prefer-node-protocol': 'error',

        // ES6
        'no-var': 'error',
        'prefer-const': [
            'error',
            {
                destructuring: 'any',
                ignoreReadBeforeAssign: true,
            },
        ],
        'prefer-arrow-callback': [
            'error',
            {
                allowNamedFunctions: false,
                allowUnboundThis: true,
            },
        ],
        'object-shorthand': [
            'error',
            'always',
            {
                ignoreConstructors: false,
                avoidQuotes: true,
            },
        ],
        'prefer-rest-params': 'error',
        'prefer-spread': 'error',
        'prefer-template': 'error',
        'template-curly-spacing': 'error',
        'arrow-parens': ['error', 'as-needed', { requireForBlockBody: true }],
        'generator-star-spacing': 'off',

        // Best practices
        'array-callback-return': 'error',
        'block-scoped-var': 'error',
        'consistent-return': 'off',
        'complexity': ['off', 11],
        'eqeqeq': ['error', 'smart'],
        'no-alert': 'warn',
        'no-case-declarations': 'error',
        'no-multi-spaces': 'error',
        'no-multi-str': 'error',
        'no-with': 'error',
        'no-void': 'error',
        'no-useless-escape': 'off',
        'vars-on-top': 'error',
        'require-await': 'off',
        'no-return-assign': 'off',
        'operator-linebreak': ['error', 'before'],

        'no-use-before-define': [
            'error',
            {
                functions: false,
                classes: false,
                variables: true,
            },
        ],
    },
}