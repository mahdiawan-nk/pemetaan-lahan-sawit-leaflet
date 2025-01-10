<style>
    /* .leaflet-popup-content-wrapper,
    .leaflet-popup-tip {
        background: white;
        color: #333;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.4);
        width: 200px;
    } */

    .leaflet-popup-content {
        margin: 13px 24px 13px 20px;
        line-height: 1.3;
        font-size: 13px;
        font-size: 1.08333em;
        min-height: 1px;
        width: 200px;
    }
</style>

<div class="pcoded-main-container" x-data="mapDataz()">

    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?= $title; ?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/dashboard"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?= $title; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="height: 650px;"> </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    function mapDataz() {
        return {
            map: null,
            drawnPolygon: null,
            drawnItems: null,
            geoJsonData: null,
            polygonCoords: {
                type: "polygon",
                coordinates: null // Menyimpan koordinat dari API
            },
            drawControl: null,
            fetchedPolygon: null, // Store fetched polygon for later removal
            init() {
                // Initialize map
                this.map = L.map('map').setView([0.4529698980669356, 101.05597555352796], 14);
                var Stadia_AlidadeSatellite = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.{ext}', {
                    minZoom: 0,
                    maxZoom: 20,
                    attribution: '&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    ext: 'jpg'
                });
                // Add OpenStreetMap tiles
                Stadia_AlidadeSatellite.addTo(this.map);
                var comp = new L.Control.Compass({autoActive: false, showDigit:false});
                this.map.addControl(comp);
                this.fetchPolygons();


            },
            async fetchPolygons() {
                try {
                    const response = await axios.get('<?= base_url('lihat_data_lahan/json_lahan') ?>');
                    this.geoJsonData = response.data;

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
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Perkiraan Replanting
                                            <span class="badge bg-primary rounded-pill">${parseInt(feature.properties.tahun_tanam) + 30}</span>
                                        </li>
                                        <li class="list-group-item  px-0">
                                            <a href="<?= base_url() ?>/lihat_data_lahan/peta_lahan/${feature.properties.id_lahan}" class="btn btn-primary w-100">Detail</a>
                                        </li>
                                    </ul>
                                `);
                }
                // Optionally, add a label directly on the polygon using a Tooltip
                layer.bindTooltip(feature.properties.blok, {
                    permanent: true,
                    direction: 'center',
                    className: 'leaflet-tooltip-text'
                }).openTooltip();
            }


        };
    }
</script>