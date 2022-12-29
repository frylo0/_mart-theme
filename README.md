# Theme Environment by @fritylo

Author: @**fritylo**, [https://github.com/fritylo](https://github.com/fritylo), [to.fritylo@gmail.com](mailto:to.fritylo@gmail.com), [https://frity.org](https://frity.org)

---

# Reference

- [Available scripts](#available-scripts)
  - [Start local development](#start-local-development)
    - [Know issues](#know-issues)
  - [Create production build](#create-production-build)
  - [Create development build](#create-development-build)
- [Technology stack](#technology-stack)
- [Entry points](#entry-points)
- [Project structure](#project-structure)

---

## Available scripts

### Start local development

```bash
yarn
yarn dev
```

#### Know issues

- When you_**add**_, then_**delete**_, then_**add again**_ same file. Webpack will tell you than there is no such file.

> **Solution**: Change content of this file and error will be resolved

- Need to exit development process two times

> **Solution**: Press `Ctrl+C` two times

- Adding new page need to restart dev mode

> **Solution**: Simply restart `yarn dev` command

### Create production build

```bash
yarn build
```

### Create development build

```bash
yarn build:dev
```

## Technology stack

1. PHP, v7.4 and higher
2. Typescript
3. SCSS
4. Webpack 5
5. Yarn Package Manager

## Entry points

1. pages/\*/\*.ts
2. components/common/entry.ts

## Project structure

- `dist` ~ Folder with builded files
- `env` ~ Special scripts for Webpack
- `node_modules` ~ Special files for Node.js
- `src` ~ Folder where you gonna work
  - `assets` ~ All files from this folders copied to ./dist/assets
    - `audios` ~ Become ./dist/assets/audios
    - `fonts` ~ Become ./dist/assets/fonts
    - `images` ~ Become ./dist/assets/images
    - `videos` ~ Become ./dist/assets/videos
  - `components` ~ Folder with reusable things of your project
    - `blocks` ~ Kind of components, that smaller than page width, but still need to be reusable
      - `emplate-block` ~ Name have to match nesters
        - `example-block.php` ~ Contains function to generate HTML
        - `example-block.scss` ~ Styles special for this block
        - `example-block.ts` ~ Both .php and .scss have to be imported here
    - `common` ~ This components are imported automatically to any page
      - `example-common` ~ Name have to match nesters
        - `example-common.php` ~ Contains function to generate HTML
        - `example-common.scss` ~ Styles special for this common component
        - `example-common.ts` ~ Both .php and .scss have to be imported here
    - `section` ~ Components those take full page width
      - `example-section` ~ Name have to match nesters
        - `example-section.php` ~ Contains function to generate HTML
        - `example-section.scss` ~ Styles special for this section
        - `example-section.ts` ~ Both .php and .scss have to be imported here
  - `pages`
    - `example-name` ~ Name of folder must match with nested files
      - `example-name.php` ~ Become ./dist/example-name.php. Styles, scripts, requirements are injected automatically
      - `example-name.scss` ~ This styles will be inserted directly to this page
      - `example-name.ts` ~\` example-name.php `,` example-name.scss\`, blocks and sections are imported here
  - `raw` ~ folder for expra .php files, e.g.`header.php` and`footer.php`
  - `assets-loader.ts` ~ Special file to load assets. Do not change it
  - `raw-loader.ts` ~ Special file to load raw files. Do not change it
- `utils` ~ Special utils for Webpack
- `.editorconfig` ~ Special config for any editor or IDE
- `.gitignore` ~ Files to be ignored by GIT
- `footer.php` ~ Special file to prevent default footer.php location
- `functions-core.php` ~ Special functions provided by this environment
- `functions.php` ~ Your config gonna be here. Forget about wp_enqueue_style, all files are imported dynamically
- `header.php` ~ Special file to prevent default header.php location
- `package.json` ~ Description of used modules for Yarn
- `postcss.config.js` ~ Config file, defines how to transpile SCSS files
- `README.md` ~ You are here now
- `style.css` ~ This file shouldn't contain any css code. Used only for theme meta data definition
- `tsconfig.json` ~ Config, defines how to work with TS files
- `webpack.config.mjs` ~ Config file for Webpack
- `webpack.reload.mjs` ~ Special script to force reload webpack when files changed. Fixes errors "Cannot find module"
- `yarn.lock` ~ List of modules downloaded by Yarn
