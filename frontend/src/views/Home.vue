<template>
    <div>
        <TakeAPhoto/>
        <HelloWorld/>
        <Gallery/>
    </div>
</template>

<script>
  import HelloWorld from '../components/HelloWorld';
  import Gallery from '../components/Gallery';
  import TakeAPhoto from '../components/TakeAPhoto';

  export default {
    components: {
      TakeAPhoto,
      HelloWorld,
      Gallery
    },
  };
</script>
