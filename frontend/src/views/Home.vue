<template>
    <div>
        <HelloWorld/>
        <Gallery/>
    </div>
</template>

<script>
  import HelloWorld from '../components/HelloWorld';
  import Gallery from '../components/Gallery';

  export default {
    components: {
      HelloWorld,
      Gallery
    },
  };
</script>
