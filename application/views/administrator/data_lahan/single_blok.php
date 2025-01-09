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
                    <div class="card-footer">
                        <a href="<?=base_url('lihat_data_lahan/print/'.$id)?>" target="_blank" class="btn btn-primary btn-block" type="button">Cetak Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="height: 550px;"> </div>
                        <div id="images"></div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url(); ?>index.php/peta_lahan" type="button" class="btn btn-warning">Kembali</a>
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
                    minZoom: 14,
                    maxZoom: 16,
                    attribution: '&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    ext: 'jpg'
                });
                // Add OpenStreetMap tiles
                Stadia_AlidadeSatellite.addTo(this.map);

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


                } catch (error) {
                    console.error('Error fetching polygons:', error);
                }
            },
            printDetail() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();
                const title = "Laporan Detail";
                doc.setFontSize(16);
                doc.text(title, 105, 20, null, null, "center");

                // Tambahkan detail laporan
                const details = {
                    "Tahun Tanam": "<?=$data->tahun_tanam?>",
                    "Nama BLOK": "<?=$data->blok?>",
                    "Luas BLOK": "<?=$data->luas_blok?> Ha",
                    "Jumlah Tandan": "<?=$data->jumlah_tandan?>",
                    "Produksi": "<?=$data->produksi?> Kg"
                };

                let yPosition = 40; // Posisi vertikal awal
                doc.setFontSize(12);
                doc.setFont("helvetica", "normal");
                for (const [key, value] of Object.entries(details)) {
                    doc.text(`${key}: ${value}`, 20, yPosition);
                    yPosition += 10; // Tambah jarak antar baris
                }

                // Buat nama file unik menggunakan timestamp
                const timestamp = new Date().toISOString().replace(/[-:.]/g, "");
                const filename = `laporan-detail-${timestamp}.pdf`;

                // Simpan file PDF
                doc.save(filename);

                // setTimeout(() => {
                //     html2canvas(document.querySelector("#map"), {
                //         useCORS: true,

                //     }).then(function(canvas) {
                //         // const imgData = canvas.toDataURL('image/png');
                //         // const doc = new jsPDF();
                //         // doc.addImage(imgData, 'PNG', 10, 10, 100, 50); // Sesuaikan ukuran
                //         // doc.save('leaflet-map.pdf');

                //     });
                // }, 500)
            }
        };
    }
</script>