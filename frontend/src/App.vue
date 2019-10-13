<template>
    <v-app>
        <v-app-bar app>
            <v-toolbar-title class="headline text-uppercase">
                <span>Foti</span>
                <span class="font-weight-light">Box</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn
                href="https://github.com/vuetifyjs/vuetify/releases/latest"
                target="_blank"
                text
            >
                <span class="mr-2">Latest Release</span>
                <v-icon>mdi-open-in-new</v-icon>
            </v-btn>
        </v-app-bar>

        <v-content>
            <router-view/>
        </v-content>
    </v-app>
</template>

<script>

  export default {
    name: 'App',
    data: () => ({
      //
    }),
  };
</script>
