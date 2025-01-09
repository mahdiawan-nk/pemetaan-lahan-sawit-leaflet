<div class="pcoded-main-container" x-data="mapData()">

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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Tahun Tanam</div>
                                </div>
                                <span class="badge bg-light rounded-pill"><?= $data->tahun_tanam; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Nama BLOK</div>
                                </div>
                                <span class="badge bg-light rounded-pill"><?= $data->blok; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Luas BLOK</div>
                                </div>
                                <span class="badge bg-light rounded-pill"><?= $data->luas_blok; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Jumlah Tandan</div>
                                </div>
                                <span class="badge bg-light rounded-pill"><?= $data->jumlah_tandan; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">PRODUKSI</div>
                                </div>
                                <span class="badge bg-light rounded-pill"><?= $data->produksi; ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="height: 550px;"> </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" @click="savePolygon">Simpan</button>
                        <!-- <button type="button" class="btn btn-danger" @click="removePolygon">Hapus Polygon</button> -->
                        <a href="<?= base_url(); ?>index.php/lihat_data_lahan" type="button" class="btn btn-warning">Kembali</a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


<script>
    function mapData() {
        return {
            map: null,
            drawnPolygon: null,
            drawnItems: null,
            polygonCoords: {
                type: "polygon",
                coordinates: null // Menyimpan koordinat dari API
            },
            drawControl: null,
            fetchedPolygon: null, // Store fetched polygon for later removal
            init() {
                this.fetchPolygons();
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

                this.drawnItems = new L.FeatureGroup();
                this.map.addLayer(this.drawnItems);

                // Initialize the draw control only once
                if (!this.drawControl) {
                    this.drawControl = new L.Control.Draw({
                        draw: {
                            polyline: false,
                            rectangle: false,
                            circle: false,
                            marker: true,
                            circlemarker: false,
                            polygon: true
                        },
                        edit: {
                            featureGroup: this.drawnItems,
                            remove: true
                        }
                    });
                    this.map.addControl(this.drawControl);
                }

                this.map.on(L.Draw.Event.CREATED, (e) => {
                    const layer = e.layer;

                    // If a polygon already exists, remove it
                    if (this.drawnPolygon) {
                        this.map.removeLayer(this.drawnPolygon);
                    }
                    let polygon = []
                    polygon.push(layer.getLatLngs()[0].map(latlng => [latlng.lng, latlng.lat]));
                    // Save the new polygon and update polygonCoords.coordinates
                    this.drawnPolygon = layer;
                    this.polygonCoords.coordinates = polygon;

                    // Add the layer to the map
                    this.map.addLayer(layer);

                    layer.on('click', () => {
                        const deleteConfirmation = confirm('Do you want to delete this polygon?');
                        if (deleteConfirmation) {
                            this.map.removeLayer(layer); // Remove the polygon from the map
                        }
                    });
                });
                if (this.drawnPolygon) {
                    this.drawControl.options.edit.featureGroup.addLayer(this.drawnPolygon);
                }
            },

            async fetchPolygons() {
                try {
                    const response = await axios.get('<?php echo base_url(); ?>index.php/lihat_data_lahan/show_polygon_lahan/<?php echo $id; ?>');
                    const dataPolygon = response.data.coordinates;
                    const coords = JSON.parse(dataPolygon); // Extract coordinates from GeoJSON
                    let polyCords = coords.coordinates;

                    // Menyesuaikan jika data bersarang
                    if (polyCords.length < 2) {
                        polyCords = polyCords[0];
                    }

                    // Perbaiki koordinat jika lat dan lng terbalik
                    polyCords = polyCords.map(point => {
                        if (Array.isArray(point) && point.length === 2) {
                            const [lng, lat] = point;
                            if (Math.abs(lng) > Math.abs(lat)) {
                                return [lat, lng]; // Tukar lat dan lng jika perlu
                            }
                        }
                        return point;
                    });

                    // Menyimpan koordinat yang diterima dari API ke dalam polygonCoords.coordinates
                    this.polygonCoords.coordinates = polyCords;

                    // Jika ada polygon sebelumnya, hapus
                    if (this.fetchedPolygon) {
                        this.map.removeLayer(this.fetchedPolygon);
                    }

                    // Tambahkan polygon baru dari API ke peta
                    this.fetchedPolygon = L.polygon(polyCords, {
                        color: 'red'
                    }).addTo(this.map);
                    this.map.fitBounds(this.fetchedPolygon.getBounds());

                    // Menambahkan polygon yang diambil dari API ke FeatureGroup
                    this.drawnItems.addLayer(this.fetchedPolygon);

                    // Tangani event saat polygon diedit
                    this.map.on(L.Draw.Event.EDITED, (event) => {
                        // Event ini dipicu saat polygon diubah
                        console.log('Polygon edited:', event.layers);
                        event.layers.eachLayer(function(layer) {
                            // Ambil koordinat baru setelah diedit
                            const updatedCoords = layer.getLatLngs();
                            let polygons=[];
                            polygons.push(layer.getLatLngs()[0].map(latlng => [latlng.lng, latlng.lat]));
                            // Masukkan koordinat yang diperbarui ke dalam polygonCoords.coordinates
                            this.polygonCoords.coordinates = polygons;
                            console.log('Updated polygonCoords:', this.polygonCoords);
                        }.bind(this)); // Ensure 'this' refers to the correct context
                    });

                    // Tangani event ketika polygon dihapus
                    this.map.on(L.Draw.Event.DELETED, (event) => {
                        console.log('Polygon deleted:', event.layers);
                    });

                } catch (error) {
                    console.error('Error fetching polygons:', error);
                }
            },

            async savePolygon() {
                // if (this.polygonCoords.coordinates.length < 3) {
                //     alert('A polygon requires at least 3 points.');
                //     return;
                // }

                console.log(this.drawnPolygon)
                let formData = new FormData();
                formData.append('polygon', JSON.stringify(this.polygonCoords));
                formData.append('id', <?php echo $id; ?>);
                formData.append('layer', '');

                try {
                    const response = await axios.post('<?= base_url(); ?>index.php/lihat_data_lahan/save_pemetaan_lahan/', formData);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    });

                    // After saving, remove the old polygon and fetch updated data
                    this.fetchPolygons(); // This will remove the old polygon and add the new one
                } catch (error) {
                    console.log(error);
                }
            },

            removePolygon() {
                if (this.fetchedPolygon) {
                    this.map.removeLayer(this.fetchedPolygon); // Remove the fetched polygon
                }
                if (this.drawnPolygon) {
                    this.map.removeLayer(this.drawnPolygon); // Remove the drawn polygon
                    this.drawnPolygon = null; // Clear the reference
                }
            }
        };
    }
</script>