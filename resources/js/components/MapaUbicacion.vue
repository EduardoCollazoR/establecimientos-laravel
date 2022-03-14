<template>
  <div class="mapa">
    <l-map :zoom="zoom" :center="center" :options="mapOptions">
      <l-tile-layer :url="url" :attribution="attribution" />
    </l-map>
  </div>
</template>

<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer } from "vue2-leaflet";
export default {
  components: {
    LMap,
    LTileLayer,
  },
  data() {
    return {
      zoom: 16,
      center: latLng(20.666332695977, -103.392177745699),
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      currentZoom: 11.5,
      mapOptions: {
        zoomSnap: 0.5,
      },
      showMap: true,
      lat: "",
      lng: "",
    };
  },
};
</script>

<style scoped>
@import "https://unpkg.com/leaftlet@1.6.0/dist/leaftlet.css";
.mapa {
  height: 300px;
  width: 100%;
}
</style>
