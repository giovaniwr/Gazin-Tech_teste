<template>
  <main id="Home-page">
    <div class="container name">
      <h3>Desenvolvedores</h3>
    </div>
    <div class="container">

      <DataTableComponentDesenvolvedor/>
    </div>
  </main>

</template>
<script>
import DataTableComponentDesenvolvedor from "@/components/DataTableComponentDesenvolvedor";

export default {
  components: {DataTableComponentDesenvolvedor}
}
</script>
<style scoped>
.name {
  text-align: center;
}
</style>
