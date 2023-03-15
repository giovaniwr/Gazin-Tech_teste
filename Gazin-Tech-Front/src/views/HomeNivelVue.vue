<template>
  <main id="Home-page">
    <div class="container name">
      <h3>Niveis</h3>
    </div>
    <div class="container">

      <DataTableComponentNivel/>
    </div>
  </main>

</template>
<script>
import DataTableComponentNivel from "@/components/DataTableComponentNivel";

export default {
  components: {DataTableComponentNivel}
}
</script>
<style scoped>
.name {
  text-align: center;
}
</style>
