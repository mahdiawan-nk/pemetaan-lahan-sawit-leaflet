<html>

<head>
    <title>A4 Page Using CSS</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.8/axios.min.js" integrity="sha512-v8+bPcpk4Sj7CKB11+gK/FnsbgQ15jTwZamnBf/xDmiQDcgOIYufBo6Acu1y30vrk8gg5su4x0CG3zfPaq5Fcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
                            <th ><?=$data->blok?></th>
                            <td><?=$data->luas_blok?></td>
                            <td><?=$data->tahun_tanam?></td>
                            <td><?=$data->jumlah_tandan?></td>
                            <td><?=$data->produksi?></td>
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
                    this.map = L.map('map',{
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
                    setInterval(() => {
                        if (this.map) {
                            window.print()
                        }
                    }, 500);


                },

                async fetchPolygons() {
                    try {
                        const response = await axios.get('<?php echo base_url(); ?>index.php/lihat_data_lahan/show_polygon_lahan/<?php echo $data->id_lahan; ?>');
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
            };
        }
    </script>
</body>

</html>