@extends('pages.template.theme')
@section('title', 'Naive Bayes Documentation')
@section('content')

    <div class="row">
        <div class="col-12">Naive Bayes Documentation</div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="container py-2 py-md-4">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="panel panel-default px-md-3">
                                <div class="panel-heading text-center alert alert-success">
                                    <i class="fas fa-book me-2"></i> PROCEDURE FOR USING THE NAIVE BAYES SYSTEM
                                </div>
                                <div class="panel-body card alert">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-badge primary"><i class="mdi mdi-database-plus"></i></div>
                                            <div class="timeline-panel ">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Create item (Attribute)</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <ol>
                                                        <li>Start</li>
                                                        <li>Go to the create item page</li>
                                                        <li>Fill in the form to add items according to the required data</li>
                                                        <li>Finish</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge primary"><i class="mdi mdi-cloud-upload"></i></div>
                                            <div class="timeline-panel ">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Import dataset</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <ol>
                                                        <li>Persiapkan data untuk dimasukkan ke dataset</li>
                                                        <li>Import dataset di halaman Dataset (file excel harus disesusaika dengan template yang telah disediakan)</li>
                                                        <li>Selesai</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge warning"><i class="mdi mdi-calculator"></i></div>
                                            <div class="timeline-panel ">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Hitung probabilitas</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <ol>
                                                        <li>Data training sudah diinput di halaman dataset / training</li>
                                                        <li>Klik tombol probabilitas untuk menghitung probabilitas berdasarkan data training</li>
                                                        <li>Data akan ditampilkan di halaman secara otomatis</li>
                                                        <li>Selesai</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </li>
                                  <li>
                                    <div class="timeline-badge success"><i class="fa fa-chart-line"></i></div>
                                    <div class="timeline-panel ">
                                      <div class="timeline-heading">
                                        <h4 class="timeline-title">Uji performa</h4>
                                      </div>
                                      <div class="timeline-body">
                                        <ol>
                                          <li>Data klasifikasi sudah dihitung terlebih dahulu</li>
                                          <li>Jika data belum diklasifikasi maka akan muncul pesan untuk mengklasifikasikan terlebih dahulu</li>
                                          <li>Jika data sudah diklasifikasi, data akan ditampilkan di halaman secara otomatis</li>
                                          <li>Selesai</li>
                                        </ol>
                                      </div>
                                    </div>
                                  </li>
                                  <li class="timeline-inverted">
                                    <div class="timeline-badge secondary"><i class="fa fa-users"></i></div>
                                    <div class="timeline-panel ">
                                      <div class="timeline-heading">
                                        <h4 class="timeline-title">Pengaturan administrator</h4>
                                      </div>
                                      <div class="timeline-body">
                                        <ol>
                                          <li>Data administrator dapat ditambahkan, diedit, dihapus  oleh admin yang sedang login di halaman Manajemen Admin</li>
                                          <li>Selesai</li>
                                        </ol>
                                      </div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')



@endsection
