<template>
    <v-container fluid>
        <v-row>
            <v-col
                :key="n"
                class="d-flex child-flex"
                cols="4"
                v-for="n in 9"
            >
                <v-card class="d-flex" flat tile>
                    <v-img
                        :lazy-src="`http://localhost:8080/v1/image/test`"
                        :src="`http://localhost:8080/v1/image/test`"
                        aspect-ratio="1"
                        class="grey lighten-2"
                    >
                        <template v-slot:placeholder>
                            <v-row
                                align="center"
                                class="fill-height ma-0"
                                justify="center"
                            >
                                <v-progress-circular color="grey lighten-5" indeterminate></v-progress-circular>
                            </v-row>
                        </template>
                    </v-img>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
  export default {
    name: 'Gallery'
  };
</script>

<style scoped>

</style>
