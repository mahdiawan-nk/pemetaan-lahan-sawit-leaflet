<!DOCTYPE html>
<html>
<head>
    <title>Leaflet Draw Example</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
</head>
<body>
    <div id="map" style="width: 100%; height: 500px;"></div>
    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([0, 0], 2);

        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Inisialisasi FeatureGroup untuk menyimpan layer yang digambar
        const drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        // Tambahkan kontrol draw ke peta
        const drawControl = new L.Control.Draw({
            edit: {
                featureGroup: drawnItems // Layer yang dapat diedit
            },
            draw: {
                polygon: true, // Aktifkan tool menggambar poligon
                polyline: true, // Aktifkan tool menggambar polyline
                rectangle: true, // Aktifkan tool menggambar rectangle
                circle: true, // Aktifkan tool menggambar lingkaran
                marker: true // Aktifkan tool menggambar marker
            }
        });
        map.addControl(drawControl);

        // Tangani event ketika layer digambar
        map.on(L.Draw.Event.CREATED, function (event) {
            const layer = event.layer; // Dapatkan layer yang baru digambar
            drawnItems.addLayer(layer); // Tambahkan ke FeatureGroup
        });
    </script>
</body>
</html>
