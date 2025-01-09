<!-- [ Main Content ] start -->
<div class="pcoded-main-container" x-data="initData">

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
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
                    Add <?= $page; ?>
                </button>
                <a href="<?= base_url(); ?>index.php/cetakexcel" type="button" class="btn btn-info btn-sm" >
                    Download Excel <?= $page; ?>
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Tanam</th>
                            <th>Blok</th>
                            <th>Luas Blok</th>
                            <th>Jumlah Tandan</th>
                            <th>Produksi(Kg)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(list, index) in listData">
                            <tr>
                                <td x-text="index + 1"></td>
                                <td x-text="list.tahun_tanam"></td>
                                <td x-text="list.blok"></td>
                                <td x-text="list.luas_blok"></td>
                                <td x-text="list.jumlah_tandan"></td>
                                <td x-text="list.produksi"></td>
                                <td>
                                    <a :href="'lihat_data_lahan/buat_polygon_lahan/' + list.id_lahan" type="button" class="btn btn-secondary btn-sm">
                                        Pemetaan Blok
                                    </a>
                                    <button type="button" class="btn btn-primary btn-sm" @click="editData(list)">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" @click="deleteData(list.id_lahan)">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
            <div class="card-footer">
                <div class="row d-flex row justify-content-between px-3">
                    <span x-text="showPaginationInfo"></span>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item" :class="{ 'disabled': pagination.currentPage === 1 }">
                                <a class="page-link" href="#" @click="prevPage">Previous</a>
                            </li>

                            <li class="page-item" :class="{ 'disabled': pagination.currentPage === pagination.totalPage }">
                                <a class="page-link" href="#" @click="nextPage">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add <?= $page; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitForm">
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Tahun tanam</label>
                                <input type="text" class="form-control" id="exampleInput" placeholder="Enter Tahun tanam" x-model="formData.tahun_tanam" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Blok</label>
                                <input type="text" name="blok" class="form-control" id="exampleInput" placeholder="Enter Blok" x-model="formData.blok" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Luas blok</label>
                                <input type="text" name="luas_blok" class="form-control" id="exampleInput" placeholder="Enter Luas blok" x-model="formData.luas_blok" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Jumlah tandan</label>
                                <input type="text" name="jumlah_tandan" class="form-control" id="exampleInput" placeholder="Enter Jumlah tandan" x-model="formData.jumlah_tandan" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Produksi(Kg)</label>
                                <input type="text" name="produksi" class="form-control" id="exampleInput" placeholder="Enter Produksi(Kg)" x-model="formData.produksi" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Edit <?= $page; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateForm">
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Tahun tanam</label>
                                <input type="text" class="form-control" id="exampleInput" placeholder="Enter Tahun tanam" x-model="formData.tahun_tanam" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Blok</label>
                                <input type="text" name="blok" class="form-control" id="exampleInput" placeholder="Enter Blok" x-model="formData.blok" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Luas blok</label>
                                <input type="text" name="luas_blok" class="form-control" id="exampleInput" placeholder="Enter Luas blok" x-model="formData.luas_blok" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Jumlah tandan</label>
                                <input type="text" name="jumlah_tandan" class="form-control" id="exampleInput" placeholder="Enter Jumlah tandan" x-model="formData.jumlah_tandan" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Produksi(Kg)</label>
                                <input type="text" name="produksi" class="form-control" id="exampleInput" placeholder="Enter Produksi(Kg)" x-model="formData.produksi" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    function initData() {
        return {
            formData: {
                tahun_tanam: '',
                blok: '',
                luas_blok: '',
                jumlah_tandan: '',
                produksi: '',
            },
            listData: [],
            pagination: {
                currentPage: 1,
                totalPage: 0,
                perPage: 10,
                totalData: 0,
            },
            init: function() {
                this.fetchData();
            },
            async fetchData(page = 1) {
                try {
                    const response = await axios.get(`lihat_data_lahan/fetch_data?page=${page}`);

                    // Update list data dan pagination
                    this.listData = response.data.data.data;
                    this.pagination = response.data.data.pagination;
                } catch (error) {
                    console.log(error);
                }
            },
            nextPage() {
                if (this.pagination.currentPage < this.pagination.totalPage) {
                    this.fetchData(this.pagination.currentPage + 1);
                }
            },
            prevPage() {
                if (this.pagination.currentPage > 1) {
                    this.fetchData(this.pagination.currentPage - 1);
                }
            },
            showPaginationInfo() {
                return `Page ${this.pagination.currentPage} of ${this.pagination.totalPage}, Showing ${this.pagination.perPage} items per page, Total ${this.pagination.totalData} items`;
            },
            async submitForm() {
                const formData = new FormData();
                formData.append('tahun_tanam', this.formData.tahun_tanam);
                formData.append('blok', this.formData.blok);
                formData.append('luas_blok', this.formData.luas_blok);
                formData.append('jumlah_tandan', this.formData.jumlah_tandan);
                formData.append('produksi', this.formData.produksi);
                try {
                    const response = await axios.post('lihat_data_lahan/submit_form', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    });
                    this.fetchData();
                    $('#myModal').modal('hide');
                } catch (error) {
                    console.log(error);
                }
            },
            editData(data) {
                this.formData = data;
                $('#editModal').modal('show');
            },
            async updateForm() {
                const formData = new FormData();
                formData.append('tahun_tanam', this.formData.tahun_tanam);
                formData.append('blok', this.formData.blok);
                formData.append('luas_blok', this.formData.luas_blok);
                formData.append('jumlah_tandan', this.formData.jumlah_tandan);
                formData.append('produksi', this.formData.produksi);
                try {
                    const response = await axios.post('lihat_data_lahan/update_lahan/' + this.formData.id_lahan, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    });
                    this.fetchData();
                    $('#editModal').modal('hide');
                } catch (error) {
                    console.log(error);
                }
            },
            async deleteData(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await axios.delete('lihat_data_lahan/delete_lahan/' + id);
                            this.fetchData();
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Data Lahan Berhasil Dihapus",
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true
                            });
                        } catch (error) {
                            console.log(error);
                        }
                    }
                });

            },
        }
    }
</script>