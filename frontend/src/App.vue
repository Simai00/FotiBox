<template>
  <v-app>
    <v-app-bar app dark>
      <router-link class="toolbar-title" to="/">
        <v-toolbar-title class="headline text-uppercase">
          <span class="white--text">Foti</span>
          <span class="white--text font-weight-light">Box</span>
        </v-toolbar-title>
      </router-link>
      <TakeAPicture/>
    </v-app-bar>
    <v-content>
      <router-view/>
    </v-content>
  </v-app>
</template>

<script>

    import TakeAPicture from './components/TakeAPicture';

    export default {
        name: 'App',
        components: { TakeAPicture },
        data: () => ({
            //
        })
    };
</script>

<style>
  .toolbar-title {
    text-decoration: none !important;
  }

  ::-webkit-scrollbar {
    display: none;
  }
</style>
