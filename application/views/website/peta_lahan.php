<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">Peta Lahan Sawit</h1>
    </div>
</div>
<!-- Page Header End -->


<!-- 404 Start -->
<div class="container-fluid wow fadeInUp" data-wow-delay="0.1s" style="min-height: 100vh;" x-data="mapData()">
    <div id="map" style="height: 95vh;"></div>
</div>
<!-- 404 End -->

<script>
    function mapData() {
        return {
            map: null,
            markers: [],
            geoJsonData: null,

            init() {
                // Inisialisasi peta
                this.map = L.map('map').setView([0.4529698980669356, 101.05597555352796], 15);
                var Stadia_AlidadeSatellite = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.{ext}', {
                    minZoom: 0,
                    maxZoom: 20,
                    attribution: '&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    ext: 'jpg'
                });
                // Add OpenStreetMap tiles
                Stadia_AlidadeSatellite.addTo(this.map);
                this.fetchPolygons();

            },

            addMarker() {
                const lat = 51.505 + (Math.random() - 0.5) * 0.1; // Random latitudes
                const lon = -0.09 + (Math.random() - 0.5) * 0.1; // Random longitudes
                const marker = L.marker([lat, lon]).addTo(this.map);
                this.markers.push(marker); // Simpan marker dalam array
            },
            async fetchPolygons() {
                try {
                    const response = await axios.get('<?= base_url('lihat_data_lahan/json_lahan') ?>');
                    this.geoJsonData = response.data;
                    console.log(this.geoJsonData);
                    // Menambahkan GeoJSON ke peta setelah file dimuat
                    L.geoJSON(this.geoJsonData, {
                        onEachFeature: this.onEachFeature,
                        style: (feature) => {
                            // Gaya khusus (jika diperlukan)
                            return {
                                color: '#ff7800',
                                weight: 2
                            };
                        }
                    }).addTo(this.map);
                } catch (error) {
                    console.error('Error fetching polygons:', error);
                }
            },
            onEachFeature(feature, layer) {
                // Add popup with text or label for each polygon
                // layer.bindPopup(feature.properties.name);
                if (feature.properties) {
                    layer.bindPopup(`
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Blok
                                            <span class="badge bg-primary rounded-pill">${feature.properties.blok}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Luas
                                            <span class="badge bg-primary rounded-pill">${feature.properties.luas_blok}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Tahun Tanam
                                            <span class="badge bg-primary rounded-pill">${feature.properties.tahun_tanam}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Jumlah Tandan
                                            <span class="badge bg-primary rounded-pill">${feature.properties.jumlah_tandan}</span>
                                        </li>
                                        
                                    </ul>
                                `);
                }
                // Optionally, add a label directly on the polygon using a Tooltip
                layer.bindTooltip(feature.properties.blok, {
                    permanent: true,
                    direction: 'center',
                    // className: 'leaflet-tooltip-text'
                }).openTooltip();
            }
        }
    }
</script>