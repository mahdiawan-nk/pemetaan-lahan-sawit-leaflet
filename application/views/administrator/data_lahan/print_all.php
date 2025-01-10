<html>

<head>
    <title>A4 Page Using CSS</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.8/axios.min.js" integrity="sha512-v8+bPcpk4Sj7CKB11+gK/FnsbgQ15jTwZamnBf/xDmiQDcgOIYufBo6Acu1y30vrk8gg5su4x0CG3zfPaq5Fcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="<?=base_url('assets/plugin/leaflet-compass.css')?>">
	<script src="<?=base_url('assets/plugin/leaflet-compass.js')?>"></script>
    <style>
        body {
            width: 230mm;
            height: 100%;
            margin: 0 auto;
            padding: 0;
            font-size: 12pt;
            background: rgb(204, 204, 204);
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .main-page {
            width: 210mm;
            min-height: 297mm;
            margin: 10mm auto;
            background: white;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        .sub-page {
            padding: 1cm;
            height: 297mm;
        }

        .page-header {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .content {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #ccc;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            thead {
                background-color: aliceblue;
                /* Ganti dengan warna latar yang diinginkan */
            }

            table,
            th,
            td {
                border: 1px solid #000;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
            }

            .main-page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body x-data="mapData()">
    <div class="main-page">
        <div class="sub-page">
            <div class="page-header">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" style="width: 100px; height: 100px">
                <h2 align='center'>PMKS PT MITRA BUMI</h2>
            </div>
            <hr>
            <div class="content">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama Blok</th>
                            <th scope="col">Luas Blok</th>
                            <th scope="col">Tahun Tanam</th>
                            <th scope="col">Jumlah Tandan</th>
                            <th scope="col">Produksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- <th ><?= $data->blok ?></th>
                            <td><?= $data->luas_blok ?></td>
                            <td><?= $data->tahun_tanam ?></td>
                            <td><?= $data->jumlah_tandan ?></td>
                            <td><?= $data->produksi ?></td> -->
                        </tr>
                    </tbody>
                </table>
                <div id="map" style="height: 550px;"> </div>
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
                    this.map = L.map('map', {
                        zoomControl: false,
                        attributionControl: false
                    }).setView([0.4529698980669356, 101.05597555352796], 14);
                    var Stadia_AlidadeSatellite = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.{ext}', {
                        minZoom: 14,
                        maxZoom: 16,
                        attribution: '&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        ext: 'jpg'
                    });
                    // Add OpenStreetMap tiles
                    Stadia_AlidadeSatellite.addTo(this.map);
                    var comp = new L.Control.Compass({
                        autoActive: false,
                        showDigit: false
                    });
                    this.map.addControl(comp);
                    setInterval(() => {
                        if (this.map) {
                            window.print()
                        }
                    }, 500);


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
</body>

</html>