<!-- [ Main Content ] start -->
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />

<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
<div class="pcoded-main-container" x-data="myFunction">

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
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->

        <div class="card">
            <div class="card-header">
                <h3>Sejarah Singkat Berdirinya Perusahaan</h3>
            </div>
            <div class="card-body">
                <div id="sejarah" x-ref="editor_sejarah">
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="simpanSejarah" @click="simpanSejarah">Simpan</button>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Visi dan Misi Perusahaan</h3>
            </div>
            <div class="card-body">
                <div id="visi" x-ref="editor_visi_misi">
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="simpanVisi" @click="simpanVisi">Simpan</button>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<script>
    function myFunction() {
        return {
            editorSejarah: null,
            editorVisi: null,
            contentSejarah: null,
            contentsVisi: null,
            floraConfig: {
                height: 300
            },
            init() {
                this.initEditorSejarah();
                this.initEditorVisi();
            },
            initEditorSejarah() {
                this.editorSejarah = new FroalaEditor('div#sejarah', {
                    height: 300,
                    events: {

                        'contentChanged': () => {
                            this.contentSejarah = this.editorSejarah.html.get();
                        }
                    }
                });
                this.fetchDataSejarah();
            },
            initEditorVisi() {
                this.editorVisi = new FroalaEditor('div#visi', {
                    height: 300,
                    events: {
                        // Menyimpan konten saat ada perubahan
                        'contentChanged': () => {
                            this.contentsVisi = this.editorVisi.html.get();
                        }
                    }
                });
                this.fetchDataVisi();
            },
            async fetchDataSejarah() {
                try {
                    const response = await axios.get(`tentang/sejarah`);
                    this.contentSejarah = response.data.data.content || '';
                    this.editorSejarah.html.set(this.contentSejarah);
                } catch (error) {
                    console.log(error);
                }
            },
            async fetchDataVisi() {
                try {
                    const response = await axios.get(`tentang/visi_misi`);
                    this.contentsVisi = response.data.data.content || '';
                    this.editorVisi.html.set(this.contentsVisi);
                } catch (error) {
                    console.log(error);
                }
            },
            async simpanSejarah() {
                try {
                    let formData = new FormData();
                    formData.append('content', this.editorSejarah.html.get());
                    const response = await axios.post(`tentang/sejarah_post`, formData);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        this.editorSejarah.html.set(response.data.data);

                    })
                } catch (error) {
                    console.log(error);
                }
            },
            async simpanVisi() {
                let formData = new FormData();
                formData.append('content', this.editorVisi.html.get());
                try {
                    const response = await axios.post(`tentang/visi_misi_post`, formData);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        this.editorVisi.html.set(response.data.data);

                    })
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>