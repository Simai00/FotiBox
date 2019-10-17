<template>
    <v-app>
        <v-app-bar app>
            <router-link to="/" class="toolbar-title">
                <v-toolbar-title class="headline text-uppercase">
                    <span>Foti</span>
                    <span class="font-weight-light">Box</span>
                </v-toolbar-title>
            </router-link>
            <v-spacer></v-spacer>
            <v-btn to="gallery">Galerie</v-btn>
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

<style>
    .toolbar-title {
        text-decoration: none !important;
        color: black !important;
    }
</style>
